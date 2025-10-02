@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>➕ Yangi Challenge qo‘shish</h2>
        <form action="{{ route('admin.challenges.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Level</label>
                <input type="number" name="level" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Sarlavha</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tavsif</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label>XP Mukofot</label>
                <input type="number" name="xp_reward" class="form-control" value="100" required>
            </div>
            <div class="mb-3">
                <label for="duration_days">⏳ Vaqt (kunlarda)</label>
                <input type="number" name="duration_days" id="duration_days" class="form-control" required min="1">
            </div>
            <button class="btn btn-success">✅ Saqlash</button>
        </form>
    </div>
@endsection

