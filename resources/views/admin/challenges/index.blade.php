@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📋 Barcha Challenge’lar</h2>
            <a href="{{ route('admin.challenges.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                ➕ Yangi Challenge qo‘shish
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3 border-b">ID</th>
                    <th class="px-4 py-3 border-b">Level</th>
                    <th class="px-4 py-3 border-b">Title</th>
                    <th class="px-4 py-3 border-b">XP Reward</th>
                    <th class="px-4 py-3 border-b">Amallar</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($challenges as $challenge)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $challenge->id }}</td>
                        <td class="px-4 py-3">{{ $challenge->level }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $challenge->title }}</td>
                        <td class="px-4 py-3">{{ $challenge->xp_reward }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('admin.challenges.edit', $challenge) }}"
                               class="inline-block px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded hover:bg-yellow-200 transition">
                                ✏️ Tahrirlash
                            </a>
                            <form action="{{ route('admin.challenges.destroy', $challenge) }}"
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Rostdan ham o‘chirmoqchimisiz?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded hover:bg-red-200 transition">
                                    🗑 O‘chirish
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

