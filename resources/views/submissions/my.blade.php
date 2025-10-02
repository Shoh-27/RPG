@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">📌 My Submissions</h2>

        @forelse($submissions as $submission)
            <div class="bg-white shadow-md rounded-lg p-5 mb-4 border border-gray-200">
                <p class="mb-2">
                    <strong class="text-gray-700">Challenge:</strong>
                    <span class="text-indigo-600 font-medium">{{ $submission->challenge->title }}</span>
                </p>

                <p class="mb-2">
                    <strong class="text-gray-700">GitHub:</strong>
                    <a href="{{ $submission->github_link }}" target="_blank" class="text-blue-600 hover:underline">
                        {{ Str::limit($submission->github_link, 50) }}
                    </a>
                </p>

                <p class="mb-2">
                    <strong class="text-gray-700">Status:</strong>
                    @if($submission->status === 'approved')
                        <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-700">✅ Approved</span>
                    @elseif($submission->status === 'rejected')
                        <span class="px-2 py-1 text-xs font-semibold rounded bg-red-100 text-red-700">❌ Rejected</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold rounded bg-yellow-100 text-yellow-700">⏳ Pending</span>
                    @endif
                </p>

                {{-- Agar izoh bo‘lsa --}}
                @if($submission->comment)
                    <p class="mb-2">
                        <strong class="text-gray-700">💬 Admin Comment:</strong>
                        <span class="italic text-gray-600">{{ $submission->comment }}</span>
                    </p>
                @endif

                {{-- Agar XP berilgan bo‘lsa --}}
                @if($submission->xp_awarded)
                    <p class="mb-2">
                        <strong class="text-gray-700">⭐ XP Awarded:</strong>
                        <span class="font-bold text-indigo-700">{{ $submission->xp_awarded }}</span>
                    </p>
                @endif
            </div>
        @empty
            <div class="bg-blue-50 text-blue-700 px-4 py-3 rounded-lg border border-blue-200">
                📭 Siz hali submission yubormagansiz.
            </div>
        @endforelse
    </div>
@endsection

