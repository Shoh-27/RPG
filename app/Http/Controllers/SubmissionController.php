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
            'status' => 'required|in:approved,rejected',
            'xp' => 'nullable|integer|min:0',
            'comment' => 'nullable|string|max:500'
        ]);

        // Status yangilash
        $submission->status = $request->status;

        // Izohni saqlash
        if ($request->filled('comment')) {
            $submission->comment = $request->comment;
        }

        // Agar approved bo‘lsa XP beramiz
        if ($request->status === 'approved' && $request->filled('xp')) {
            $submission->xp_awarded = $request->xp; // submission jadvalida xp_awarded maydoni bo‘lsin

            // Userga XP qo‘shamiz
            $user = $submission->user;
            $user->xp += $request->xp;

            // Level system: har 100 XP = 1 level (misol uchun)
            while ($user->xp >= 100) {
                $user->xp -= 100;
                $user->level += 1;
            }

            $user->save();
        }

        $submission->save();

        return back()->with('success', 'Submission updated successfully!');
    }

}
