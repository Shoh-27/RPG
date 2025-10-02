@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">📌 Submissions</h2>

        {{-- ✅ Success / Error alert --}}
        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 shadow">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 shadow">
                {{ session('error') }}
            </div>
        @endif

        @forelse($submissions as $submission)
            <div class="bg-white rounded-xl shadow p-5 mb-4 border border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="mb-1 text-sm text-gray-700">
                            <strong class="text-gray-900">User:</strong> {{ $submission->user->name }}
                            <span class="ml-2 px-2 py-0.5 text-xs bg-indigo-100 text-indigo-700 rounded-full">
                                Level {{ $submission->user->level }}
                            </span>
                        </p>
                        <p class="mb-1 text-sm"><strong class="text-gray-900">Challenge:</strong> {{ $submission->challenge->title }}</p>
                        <p class="mb-1 text-sm">
                            <strong class="text-gray-900">GitHub:</strong>
                            <a href="{{ $submission->github_link }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ Str::limit($submission->github_link, 40) }}
                            </a>
                        </p>
                        <p class="mb-1 text-sm">
                            <strong class="text-gray-900">Status:</strong>
                            @if($submission->status === 'pending')
                                <span class="px-2 py-0.5 text-xs bg-yellow-100 text-yellow-700 rounded">Pending</span>
                            @elseif($submission->status === 'approved')
                                <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded">Approved</span>
                            @else
                                <span class="px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded">Rejected</span>
                            @endif
                        </p>
                    </div>

                    {{-- ✅ Approve/Reject buttons --}}
                    <div class="text-right space-y-3 w-64">
                        @if($submission->status === 'pending')
                            {{-- Approve with XP --}}
                            <form action="{{ route('admin.submissions.updateStatus', $submission) }}" method="POST" class="bg-green-50 p-3 rounded-lg shadow-sm">
                                @csrf
                                <input type="hidden" name="status" value="approved">

                                <label class="block text-xs text-gray-600">XP berish:</label>
                                <input type="number" name="xp"
                                       class="w-full p-2 mb-2 text-sm border rounded-lg focus:ring focus:ring-green-200"
                                       placeholder="Masalan: 80" required>

                                <label class="block text-xs text-gray-600">Izoh:</label>
                                <textarea name="comment"
                                          class="w-full p-2 text-sm border rounded-lg focus:ring focus:ring-green-200"
                                          placeholder="Nima uchun 80 XP berildi?"></textarea>

                                <button class="mt-2 w-full bg-green-600 hover:bg-green-700 text-white text-sm py-2 rounded-lg shadow transition">
                                    ✅ Approve
                                </button>
                            </form>

                            {{-- Reject --}}
                            <form action="{{ route('admin.submissions.updateStatus', $submission) }}" method="POST" class="bg-red-50 p-3 rounded-lg shadow-sm">
                                @csrf
                                <input type="hidden" name="status" value="rejected">

                                <label class="block text-xs text-gray-600">Izoh (nechun reject):</label>
                                <textarea name="comment"
                                          class="w-full p-2 text-sm border rounded-lg focus:ring focus:ring-red-200"></textarea>

                                <button class="mt-2 w-full bg-red-600 hover:bg-red-700 text-white text-sm py-2 rounded-lg shadow transition">
                                    ❌ Reject
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="p-5 rounded-lg bg-blue-50 text-blue-700 shadow">📭 Hali hech qanday submission yo‘q.</div>
        @endforelse
    </div>
@endsection

