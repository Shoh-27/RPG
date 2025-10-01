@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>📌 Submissions</h2>

        @foreach($submissions as $submission)
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>User:</strong> {{ $submission->user->name }} (Level: {{ $submission->user->level }})</p>
                    <p><strong>Challenge:</strong> {{ $submission->challenge->title }}</p>
                    <p><strong>GitHub:</strong> <a href="{{ $submission->github_link }}" target="_blank">{{ $submission->github_link }}</a></p>
                    <p><strong>Status:</strong> {{ ucfirst($submission->status) }}</p>

                    <form action="{{ route('admin.submissions.updateStatus', $submission) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button class="btn btn-success btn-sm">✅ Approve</button>
                    </form>

                    <form action="{{ route('admin.submissions.updateStatus', $submission) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button class="btn btn-danger btn-sm">❌ Reject</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

