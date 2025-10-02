<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;

class ChallengeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Hamma challenge’larni olamiz
        $challenges = Challenge::orderBy('level')->get();

        // Foydalanuvchi faqat o‘z leveligacha ko‘rishi mumkin
        $availableChallenges = $challenges->filter(function ($challenge) use ($user) {
            return $challenge->level <= $user->level;
        });

        return view('challenges.index', [
            'challenges' => $availableChallenges,
            'user' => $user,
        ]);
    }



    /**
     * Admin uchun — barcha challenge’larni ko‘rish
     */
    public function allChallenges()
    {
        $challenges = Challenge::all();
        return view('admin.challenges.index', compact('challenges'));
    }

    /**
     * Admin uchun — create form
     */
    public function create()
    {
        return view('admin.challenges.create');
    }

    /**
     * Admin uchun — yangi challenge qo‘shish
     */
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'xp_reward' => 'required|integer|min:1',
            'duration_days' => 'required|integer|min:1'
        ]);

        Challenge::create([
            'level' => $request->level,
            'title' => $request->title,
            'description' => $request->description,
            'xp_reward' => $request->xp_reward,
            'duration_days' => $request->duration_days
        ]);

        return redirect()->route('admin.challenges.index')
            ->with('success', '✅ Challenge qo‘shildi!');
    }

    /**
     * Admin uchun — edit form
     */
    public function edit(Challenge $challenge)
    {
        return view('admin.challenges.edit', compact('challenge'));
    }

    /**
     * Admin uchun — challenge yangilash
     */
    public function update(Request $request, Challenge $challenge)
    {
        $request->validate([
            'level' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'xp_reward' => 'required|integer',
        ]);

        $challenge->update($request->all());

        return redirect()->route('admin.challenges.index')->with('success', '✏️ Challenge yangilandi!');
    }

    /**
     * Admin uchun — challenge o‘chirish
     */
    public function destroy(Challenge $challenge)
    {
        $challenge->delete();
        return redirect()->route('admin.challenges.index')->with('success', '🗑 Challenge o‘chirildi!');
    }
}
