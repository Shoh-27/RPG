{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <h3>Salom, {{ auth()->user()->name }}!</h3>
            <p>Level: {{ auth()->user()->level }}</p>
            <p>XP: {{ auth()->user()->xp }} / {{ auth()->user()->xpToNextLevel() }}</p>

            <div class="progress" style="height:20px">
                <div class="progress-bar" role="progressbar" style="width: {{ auth()->user()->currentProgress() }}%">
                    {{ round(auth()->user()->currentProgress()) }}%
                </div>
            </div>
        @else
            <div class="alert alert-info">Iltimos tizimga kiring.</div>
        @endauth
    </div>
@endsection
