@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">🏆 Leaderboard</h2>

        <table class="table table-striped table-hover shadow-sm">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Foydalanuvchi</th>
                <th>Level</th>
                <th>XP</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <span class="badge bg-primary">Lv {{ $user->level }}</span>
                    </td>
                    <td>{{ $user->xp }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
