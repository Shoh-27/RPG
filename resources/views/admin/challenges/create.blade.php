@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">➕ Yangi Challenge qo‘shish</h2>

        <form action="{{ route('admin.challenges.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                <input type="number" name="level" required
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sarlavha</label>
                <input type="text" name="title" required
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tavsif</label>
                <textarea name="description" rows="4" required
                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">XP Mukofot</label>
                <input type="number" name="xp_reward" value="100" required
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="duration_days" class="block text-sm font-medium text-gray-700 mb-1">⏳ Vaqt (kunlarda)</label>
                <input type="number" name="duration_days" id="duration_days" required min="1"
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg shadow hover:bg-green-700 transition">
                    ✅ Saqlash
                </button>
            </div>
        </form>
    </div>
@endsection

