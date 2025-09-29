<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $challenge = Challenge::where('level', $user->level)->first();

        return view('challenges.index', compact('challenge'));
    }

}
