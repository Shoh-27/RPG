@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>🚀 Challenge Boshlash</h2>

        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $challenge->title }}</h4>
                <p>{{ $challenge->description }}</p>
                <p><strong>XP:</strong> {{ $challenge->xp_reward }}</p>
                <p><strong>Deadline:</strong> {{ $deadline->format('Y-m-d H:i') }}</p>
                <p><strong>Qolgan vaqt:</strong> {{ $deadline->diffForHumans() }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>📤 Github link yuborish</h5>
                <form action="{{ route('submissions.store', $challenge) }}" method="POST">
                    @csrf
                    <input type="url" name="github_link" class="form-control mb-2" required placeholder="https://github.com/username/repo">
                    <button class="btn btn-primary">Topshirish</button>
                </form>
            </div>
        </div>
    </div>
@endsection

