<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Challenge;
use Illuminate\Support\Facades\DB;

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
            return redirect()->route('dashboard')->with('success', 'Challenge topshirildi!');
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

        // Prevent double-processing
        if ($submission->status !== 'pending') {
            return back()->with('warning', 'Bu submission allaqachon tekshirilgan.');
        }

        DB::transaction(function () use ($request, $submission) {
            // Default xp — challenge xp_reward yoki admin kiritgan xp
            $xpToAdd = null;
            if ($request->status === 'approved') {
                $xpToAdd = $request->filled('xp') ? (int)$request->xp : (int)$submission->challenge->xp_reward;
                $submission->xp_awarded =+ $xpToAdd;
            } else {
                $submission->xp_awarded = 0;
            }

            if ($request->filled('comment')) {
                $submission->comment = $request->comment;
            }

            // Avval submission status va meta saqlaymiz
            $submission->status = $request->status;
            $submission->save();

            // Foydalanuvchiga XP faqat approved bo'lsa beriladi
            if ($request->status === 'approved' && $xpToAdd > 0) {
                // Userni lock qilish — race condition oldini olish uchun
                $user = \App\Models\User::where('id', $submission->user_id)->lockForUpdate()->first();

                // addXp() metodidan foydalanamiz (yuqorida yozilgan)
                $user->addXp($xpToAdd);
            }
        });

        return back()->with('success', '✅ Submission status yangilandi!');
    }

    public function start(Challenge $challenge)
    {
        $user = auth()->user();

        // Foydalanuvchi challenge bosgan vaqtni saqlash
        // (agar avval start bosmagan bo‘lsa)
        if (!$user->startedChallenges()->where('challenge_id', $challenge->id)->exists()) {
            $user->startedChallenges()->attach($challenge->id, [
                'started_at' => now()
            ]);
        }

        // Boshlangan vaqtni olish
        $pivot = $user->startedChallenges()->where('challenge_id', $challenge->id)->first()->pivot;
        $deadline = \Carbon\Carbon::parse($pivot->started_at)->addDays($challenge->duration_days);

        return view('challenges.start', compact('challenge', 'deadline'));
    }


}
