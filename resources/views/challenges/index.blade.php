@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">📌 Sizning Challenge</h2>

        {{-- Flash message --}}
        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($challenges->isEmpty())
            <div class="alert alert-info shadow-sm rounded">Hozircha siz uchun challenge yo‘q.</div>
        @else
            @foreach($challenges as $challenge)
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body">
                        <h4 class="fw-bold">{{ $challenge->title }}</h4>
                        <p class="text-muted">{{ $challenge->description }}</p>
                        <p><strong>XP:</strong> 🎯 {{ $challenge->xp_reward }}</p>

                        <form action="{{ route('submissions.store', $challenge) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="input-group">
                                <input type="url" name="github_link" class="form-control" required
                                       placeholder="🔗 https://github.com/username/repo">
                                <button class="btn btn-primary">🚀 Topshirish</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection


