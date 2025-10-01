@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">📌 Mening topshiriqlarim</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse($submissions as $submission)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <p><strong>Challenge:</strong> {{ $submission->challenge->title }}</p>
                    <p>
                        <strong>GitHub:</strong>
                        <a href="{{ $submission->github_link }}" target="_blank">{{ $submission->github_link }}</a>
                    </p>
                    <p>
                        <strong>Status:</strong>
                        @if($submission->status === 'pending')
                            <span class="badge bg-warning text-dark">⏳ Pending</span>
                        @elseif($submission->status === 'approved')
                            <span class="badge bg-success">✅ Approved</span>
                        @else
                            <span class="badge bg-danger">❌ Rejected</span>
                        @endif
                    </p>
                </div>
            </div>
        @empty
            <div class="alert alert-info">📭 Siz hali hech qanday submission yubormagansiz.</div>
        @endforelse
    </div>
@endsection

