@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">📌 Submissions</h2>

        {{-- ✅ Success / Error alert --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @forelse($submissions as $submission)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1"><strong>User:</strong> {{ $submission->user->name }}
                                <span class="badge bg-primary">Level {{ $submission->user->level }}</span>
                            </p>
                            <p class="mb-1"><strong>Challenge:</strong> {{ $submission->challenge->title }}</p>
                            <p class="mb-1">
                                <strong>GitHub:</strong>
                                <a href="{{ $submission->github_link }}" target="_blank">
                                    {{ Str::limit($submission->github_link, 40) }}
                                </a>
                            </p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                @if($submission->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($submission->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </p>
                        </div>

                        {{-- ✅ Approve/Reject buttons --}}
                        <div class="text-end">
                            @if($submission->status === 'pending')
                                <form action="{{ route('admin.submissions.updateStatus', $submission) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button class="btn btn-success btn-sm">✅ Approve</button>
                                </form>

                                <form action="{{ route('admin.submissions.updateStatus', $submission) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">

                                    <div class="form-group mb-2">
                                        <label>XP berish:</label>
                                        <input type="number" name="xp" class="form-control form-control-sm" placeholder="Masalan: 80" required>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label>Izoh:</label>
                                        <textarea name="comment" class="form-control form-control-sm" placeholder="Nima uchun 80 XP berildi?"></textarea>
                                    </div>

                                    <button class="btn btn-success btn-sm">✅ Approve</button>
                                </form>

                                <form action="{{ route('admin.submissions.updateStatus', $submission) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">

                                    <div class="form-group mb-2">
                                        <label>Izoh (nechun reject):</label>
                                        <textarea name="comment" class="form-control form-control-sm"></textarea>
                                    </div>

                                    <button class="btn btn-danger btn-sm">❌ Reject</button>
                                </form>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">📭 Hali hech qanday submission yo‘q.</div>
        @endforelse
    </div>
@endsection
