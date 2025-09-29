@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Level {{ $challenge->level }}: {{ $challenge->title }}</h2>
        <p>{{ $challenge->description }}</p>
        <p><strong>XP mukofot:</strong> {{ $challenge->xp_reward }}</p>

        <form action="{{ route('submissions.store', $challenge) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="github_link" class="form-label">GitHub linkingiz</label>
                <input type="url" name="github_link" id="github_link" class="form-control" required>
            </div>
            <button class="btn btn-primary">Topshirish</button>
        </form>
    </div>
@endsection

