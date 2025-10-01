@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>📌 My Submissions</h2>

        @forelse($submissions as $submission)
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>Challenge:</strong> {{ $submission->challenge->title }}</p>
                    <p><strong>GitHub:</strong> <a href="{{ $submission->github_link }}" target="_blank">{{ $submission->github_link }}</a></p>
                    <p><strong>Status:</strong>
                        @if($submission->status === 'approved')
                            <span class="badge bg-success">✅ Approved</span>
                        @elseif($submission->status === 'rejected')
                            <span class="badge bg-danger">❌ Rejected</span>
                        @else
                            <span class="badge bg-warning text-dark">⏳ Pending</span>
                        @endif
                    </p>

                    {{-- Agar izoh bo‘lsa, chiqaramiz --}}
                    @if($submission->comment)
                        <p><strong>Admin Comment:</strong> {{ $submission->comment }}</p>
                    @endif

                    {{-- Agar XP berilgan bo‘lsa --}}
                    @if($submission->xp_awarded)
                        <p><strong>XP Awarded:</strong> {{ $submission->xp_awarded }}</p>
                    @endif
                </div>
            </div>
        @empty
            <p>📭 Siz hali submission yubormagansiz.</p>
        @endforelse
    </div>
@endsection
