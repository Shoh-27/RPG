@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>📌 Challenges</h2>

        @foreach($challenges as $challenge)
            <div class="card mb-3">
                <div class="card-body">
                    <h4>{{ $challenge->title }}</h4>
                    <p>{{ $challenge->description }}</p>
                    <p><strong>XP:</strong> {{ $challenge->xp_reward }}</p>
                    <p><strong>Duration:</strong> {{ $challenge->duration_days }} kun</p>

                    @php
                        $submission = $challenge->submissions()
                            ->where('user_id', auth()->id())
                            ->first();
                    @endphp

                    {{-- Agar user boshlamagan bo‘lsa --}}
                    @if(!$submission || !$submission->started_at)
                        <form action="{{ route('challenges.start', $challenge) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">🚀 Start Challenge</button>
                        </form>
                    @else
                        <p><strong>Started:</strong> {{ $submission->started_at->format('d M Y H:i') }}</p>
                        <p><strong>Deadline:</strong> {{ $submission->deadline->format('d M Y H:i') }}</p>

                        {{-- Agar hali topshirmagan bo‘lsa --}}
                        @if($submission->status === 'pending')
                            <form action="{{ route('submissions.store', $challenge) }}" method="POST">
                                @csrf
                                <input type="url" name="github_link" class="form-control mb-2" required placeholder="https://github.com/username/repo">
                                <button class="btn btn-success">📤 Submit Project</button>
                            </form>
                        @else
                            <p><strong>Status:</strong> {{ ucfirst($submission->status) }}</p>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
