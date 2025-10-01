<?php

namespace App\Http\Controllers;

use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        // XP bo‘yicha tartiblab, eng top foydalanuvchilarni chiqaramiz
        $users = User::orderByDesc('xp')
            ->orderByDesc('level')
            ->take(20) // faqat top 20 foydalanuvchi
            ->get();

        return view('leaderboard.index', compact('users'));
    }
}
