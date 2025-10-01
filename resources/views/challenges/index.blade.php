@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>📌 Sizning Challenge</h2>

        @if(!$challenge)
            <div class="alert alert-info">Hozircha siz uchun challenge yo‘q.</div>
        @else
            <div class="card mb-3">
                <div class="card-body">
                    <h4>{{ $challenge->title }}</h4>
                    <p>{{ $challenge->description }}</p>
                    <p><strong>XP:</strong> {{ $challenge->xp_reward }}</p>

                    <form action="{{ route('submissions.store', $challenge) }}" method="POST">
                        @csrf
                        <input type="url" name="github_link" class="form-control mb-2" required placeholder="https://github.com/username/repo">
                        <button class="btn btn-primary">Topshirish</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection


