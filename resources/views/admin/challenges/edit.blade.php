@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            ✏️ Challenge tahrirlash
        </h2>

        <form action="{{ route('admin.challenges.update', $challenge) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium mb-1">Level</label>
                <input type="number" name="level" value="{{ $challenge->level }}" required
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 outline-none shadow-sm">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Sarlavha</label>
                <input type="text" name="title" value="{{ $challenge->title }}" required
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 outline-none shadow-sm">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Tavsif</label>
                <textarea name="description" rows="4" required
                          class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 outline-none shadow-sm">{{ $challenge->description }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">XP Mukofot</label>
                <input type="number" name="xp_reward" value="{{ $challenge->xp_reward }}" required
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 outline-none shadow-sm">
            </div>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                💾 Yangilash
            </button>
        </form>
    </div>
@endsection
