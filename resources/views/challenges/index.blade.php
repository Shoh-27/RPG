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
                        $pivot = auth()->user()
                            ->startedChallenges()
                            ->where('challenge_id', $challenge->id)
                            ->first()?->pivot;
                    @endphp

                    {{-- Agar user hali boshlamagan bo‘lsa --}}
                    @if(!$pivot)
                        <a href="{{ route('challenges.start', $challenge) }}" class="btn btn-primary">
                            🚀 Start Challenge
                        </a>
                    @else
                        <p><strong>Started:</strong> {{ \Carbon\Carbon::parse($pivot->started_at)->format('d M Y H:i') }}</p>
                        <p>
                            <strong>Deadline:</strong>
                            {{ \Carbon\Carbon::parse($pivot->started_at)->addDays($challenge->duration_days)->format('d M Y H:i') }}
                        </p>

                        {{-- Submissionni tekshirish --}}
                        @php
                            $submission = $challenge->submissions()
                                ->where('user_id', auth()->id())
                                ->latest()
                                ->first();
                        @endphp

                        @if(!$submission)
                            <form action="{{ route('submissions.store', $challenge) }}" method="POST">
                                @csrf
                                <input type="url" name="github_link" class="form-control mb-2" required placeholder="https://github.com/username/repo">
                                <button class="btn btn-success">📤 Submit Project</button>
                            </form>
                        @else
                            <p><strong>Status:</strong> {{ ucfirst($submission->status) }}</p>
                            @if($submission->comment)
                                <p><strong>Admin izohi:</strong> {{ $submission->comment }}</p>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
