@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">🏆 Leaderboard</h2>

        <div class="overflow-hidden rounded-xl shadow-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-900 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Foydalanuvchi</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Level</th>
                    <th class="px-6 py-3 text-right text-sm font-semibold uppercase tracking-wider">XP</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                @foreach($users as $index => $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 text-gray-700 font-bold">
                            @if($index === 0)
                                🥇
                            @elseif($index === 1)
                                🥈
                            @elseif($index === 2)
                                🥉
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td class="px-6 py-3 text-gray-900 font-semibold">{{ $user->name }}</td>
                        <td class="px-6 py-3 text-center">
                                <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-medium">
                                    Lv {{ $user->level }}
                                </span>
                        </td>
                        <td class="px-6 py-3 text-right text-gray-700 font-semibold">{{ $user->xp }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

