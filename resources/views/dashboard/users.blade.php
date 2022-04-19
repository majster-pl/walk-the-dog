@extends("layouts.dashboard", ['title' => 'Users'])
@section('content-card-title')
    <span class="fs-4">
        Manage all users
    </span>
@endsection
@section('content-card')
    <div class="list-group">
        @if ($users->count())
            @foreach ($users as $user)
                <p>{{ $user }}</p>
            @endforeach
        @else
            You didn't add any places yet...
        @endif
    </div>

@endsection
