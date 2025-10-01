@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>✏️ Challenge tahrirlash</h2>
        <form action="{{ route('admin.challenges.update', $challenge) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Level</label>
                <input type="number" name="level" class="form-control" value="{{ $challenge->level }}" required>
            </div>
            <div class="mb-3">
                <label>Sarlavha</label>
                <input type="text" name="title" class="form-control" value="{{ $challenge->title }}" required>
            </div>
            <div class="mb-3">
                <label>Tavsif</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $challenge->description }}</textarea>
            </div>
            <div class="mb-3">
                <label>XP Mukofot</label>
                <input type="number" name="xp_reward" class="form-control" value="{{ $challenge->xp_reward }}" required>
            </div>
            <button class="btn btn-primary">💾 Yangilash</button>
        </form>
    </div>
@endsection

