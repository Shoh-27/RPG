{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <h3>Salom, {{ auth()->user()->name }}!</h3>
            <p><strong>Level:</strong> {{ auth()->user()->level }}</p>
            <p><strong>XP:</strong> {{ auth()->user()->xp }} / {{ auth()->user()->xpToNextLevel() }}</p>

            {{-- Progress Bar --}}
            <div class="progress mb-3" style="height:20px">
                <div class="progress-bar bg-success"
                     role="progressbar"
                     style="width: {{ auth()->user()->currentProgress() }}%">
                    {{ round(auth()->user()->currentProgress()) }}%
                </div>
            </div>

            {{-- Role-based navigation --}}
            @if(auth()->user()->isAdmin())
                <div class="mt-4">
                    <a href="{{ route('admin.challenges.index') }}" class="btn btn-primary">📌 Manage Challenges</a>
                    <a href="{{ route('admin.submissions.index') }}" class="btn btn-warning">📥 Review Submissions</a>
                    <a href="{{ route('challenges.index') }}" class="btn btn-success">🚀 Start Challenges</a>
                    <a href="{{ route('submissions.my') }}" class="btn btn-info">📂 My Submissions</a>
                </div>
            @else
                <div class="mt-4">
                    <a href="{{ route('challenges.index') }}" class="btn btn-success">🚀 Start Challenges</a>
                    <a href="{{ route('submissions.my') }}" class="btn btn-info">📂 My Submissions</a>
                </div>
            @endif

        @else
            <div class="alert alert-info">Iltimos, tizimga kiring.</div>
        @endauth
    </div>
@endsection
