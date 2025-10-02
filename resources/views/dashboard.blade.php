@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @auth
            <h3 class="text-2xl font-bold text-gray-800 mb-4">
                👋 Salom, <span class="text-indigo-600">{{ auth()->user()->name }}</span>!
            </h3>

            <div class="bg-white shadow-md rounded-lg p-5 mb-6 border border-gray-200">
                <p class="mb-2">
                    <strong class="text-gray-700">Level:</strong>
                    <span class="text-indigo-600 font-semibold">{{ auth()->user()->level }}</span>
                </p>
                <p class="mb-4">
                    <strong class="text-gray-700">XP:</strong>
                    {{ auth()->user()->xp }} / {{ auth()->user()->xpToNextLevel() }}
                </p>

                {{-- Progress Bar --}}
                <div class="w-full bg-gray-200 rounded-full h-5">
                    <div class="bg-green-500 h-5 rounded-full text-xs font-semibold text-white text-center"
                         style="width: {{ auth()->user()->currentProgress() }}%">
                        {{ round(auth()->user()->currentProgress()) }}%
                    </div>
                </div>
            </div>

            {{-- Role-based navigation --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.challenges.index') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow text-center">
                        📌 Manage Challenges
                    </a>
                    <a href="{{ route('admin.submissions.index') }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow text-center">
                        📥 Review Submissions
                    </a>
                @endif

                <a href="{{ route('challenges.index') }}"
                   class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow text-center">
                    🚀 Start Challenges
                </a>
                <a href="{{ route('submissions.my') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow text-center">
                    📂 My Submissions
                </a>
                <a href="{{ route('leaderboard.index') }}"
                   class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded-lg shadow text-center">
                    🏆 Leaderboard
                </a>
            </div>

        @else
            <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-700 p-4 rounded-md">
                Iltimos, tizimga kiring.
            </div>
        @endauth
    </div>
@endsection

