<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Challenge;

class SubmissionController extends Controller
{
    /**
     * User → GitHub link yuboradi
     */
    public function store(Request $request, Challenge $challenge)
    {
        $request->validate([
            'github_link' => 'required|url',
        ]);

        Submission::create([
            'user_id' => auth()->id(),
            'challenge_id' => $challenge->id,
            'github_link' => $request->github_link,
            'status' => 'pending',
        ]);

        return back()->with('success', '✅ Loyihangiz yuborildi! Admin tekshiradi.');
    }

    /**
     * Admin → barcha submissionlarni ko‘rish
     */
    public function index()
    {
        $submissions = Submission::with('user', 'challenge')->latest()->get();
        return view('admin.submissions.index', compact('submissions'));
    }

    /**
     * Admin → tasdiqlash yoki rad etish
     */
    public function updateStatus(Request $request, Submission $submission)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $submission->status = $request->status;
        $submission->save();

        // Agar approved bo‘lsa XP qo‘shamiz
        if ($submission->status === 'approved') {
            $user = $submission->user;
            $challenge = $submission->challenge;

            $user->xp += $challenge->xp_reward;

            // XP 100 ga teng yoki oshsa → level up
            if ($user->xp >= $user->level * 100) {
                $user->level++;
            }

            $user->save();
        }

        return back()->with('success', '✅ Submission status yangilandi!');
    }
}
