<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Challenge;

class SubmissionController extends Controller
{
    /**
     * Foydalanuvchi faqat o‘z submissionlarini ko‘radi
     */
    public function mySubmissions()
    {
        $submissions = Submission::with('challenge')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('submissions.my', compact('submissions'));
    }

    /**
     * Foydalanuvchi → GitHub link yuboradi
     */
    public function store(Request $request, Challenge $challenge)
    {
        $request->validate([
            'github_link' => ['required', 'url'],
        ]);

        // Bir challenge uchun foydalanuvchi faqat bitta submission yuborsin
        $existing = Submission::where('user_id', auth()->id())
            ->where('challenge_id', $challenge->id)
            ->first();

        if ($existing) {
            return back()->with('error', '❌ Siz bu challenge uchun allaqachon topshiriq yuborgansiz.');
        }

        Submission::create([
            'user_id'     => auth()->id(),
            'challenge_id'=> $challenge->id,
            'github_link' => $request->github_link,
            'status'      => 'pending',
        ]);

        return back()->with('success', '✅ Loyihangiz yuborildi! Admin tekshiradi.');
    }

    /**
     * Admin → barcha submissionlarni ko‘rish
     */
    public function index()
    {
        $submissions = Submission::with(['user', 'challenge'])
            ->latest()
            ->get();

        return view('admin.submissions.index', compact('submissions'));
    }

    /**
     * Admin → tasdiqlash yoki rad etish
     */
    public function updateStatus(Request $request, Submission $submission)
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ]);

        $submission->update([
            'status' => $request->status,
        ]);

        // ✅ Agar approved bo‘lsa → foydalanuvchiga XP beriladi
        if ($request->status === 'approved') {
            $user = $submission->user;
            $challenge = $submission->challenge;

            $user->xp += $challenge->xp_reward;

            // XP → level calculation (masalan: har 100 XP da level up)
            while ($user->xp >= $user->level * 100) {
                $user->level++;
            }

            $user->save();
        }

        return back()->with('success', '✅ Submission status yangilandi!');
    }
}
