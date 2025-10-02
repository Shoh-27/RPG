@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">📚 Available Challenges</h2>

<div class="grid gap-4 md:grid-cols-2">
    @foreach($challenges as $challenge)
        <div class="bg-white shadow-md rounded-xl p-5 border border-gray-100 hover:shadow-lg transition">
            <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $challenge->title }}</h4>

            <form action="{{ route('challenges.start', $challenge->id) }}" method="POST">
                @csrf
                <button
                    class="mt-3 w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded-lg shadow transition">
                    🚀 Start Challenge
                </button>
            </form>
        </div>
    @endforeach
</div>
@endsection


