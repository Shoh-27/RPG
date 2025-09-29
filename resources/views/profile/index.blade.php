@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Profil</h2>
        <p><strong>Ism:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Level:</strong> {{ $user->level }}</p>
        <p><strong>XP:</strong> {{ $user->xp }} / {{ $neededXp }}</p>

        <div style="background:#ddd; width:300px; height:20px; border-radius:5px;">
            <div style="background:#4caf50; width:{{ $progress }}%; height:100%; border-radius:5px;"></div>
        </div>
    </div>
@endsection

