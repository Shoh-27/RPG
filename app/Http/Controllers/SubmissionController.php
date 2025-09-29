<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
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

        return back()->with('success', 'Loyihangiz yuborildi, admin tekshiradi!');
    }

}
