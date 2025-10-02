@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">🚀 Challenge Boshlash</h2>

        <!-- Challenge ma'lumotlari -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-6 border border-gray-100">
            <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $challenge->title }}</h4>
            <p class="text-gray-700 mb-3">{{ $challenge->description }}</p>

            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                <p><strong class="font-medium">⭐ XP:</strong> {{ $challenge->xp_reward }}</p>
                <p><strong class="font-medium">⏳ Deadline:</strong> {{ $deadline->format('Y-m-d H:i') }}</p>
                <p><strong class="font-medium">🕒 Qolgan vaqt:</strong> {{ $deadline->diffForHumans() }}</p>
            </div>
        </div>

        <!-- Github link yuborish -->
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-100">
            <h5 class="text-lg font-semibold text-gray-900 mb-4">📤 GitHub link yuborish</h5>

            <form action="{{ route('submissions.store', $challenge) }}" method="POST" class="space-y-4">
                @csrf
                <input
                    type="url"
                    name="github_link"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required
                    placeholder="https://github.com/username/repo"
                >
                <button
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded-lg shadow transition">
                    ✅ Topshirish
                </button>
            </form>
        </div>
    </div>
@endsection

