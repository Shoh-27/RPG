@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>📋 Barcha Challenge’lar</h2>
        <a href="{{ route('admin.challenges.create') }}" class="btn btn-primary mb-3">➕ Yangi Challenge qo‘shish</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Level</th>
                <th>Title</th>
                <th>XP Reward</th>
                <th>Amallar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($challenges as $challenge)
                <tr>
                    <td>{{ $challenge->id }}</td>
                    <td>{{ $challenge->level }}</td>
                    <td>{{ $challenge->title }}</td>
                    <td>{{ $challenge->xp_reward }}</td>
                    <td>
                        <a href="{{ route('admin.challenges.edit', $challenge) }}" class="btn btn-warning btn-sm">✏️ Tahrirlash</a>
                        <form action="{{ route('admin.challenges.destroy', $challenge) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑 O‘chirish</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
