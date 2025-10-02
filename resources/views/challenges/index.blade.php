<h2>Available Challenges</h2>

@foreach($challenges as $challenge)
    <div class="card mb-3 p-3">
        <h4>{{ $challenge->title }}</h4>

        <form action="{{ route('challenges.start', $challenge->id) }}" method="POST">
            @csrf
            <button class="btn btn-primary">🚀 Start Challenge</button>
        </form>
    </div>
@endforeach
