@extends("layouts.dashboard")
@section('content-card-title')
Manage all users
@endsection
@section('content-card')
    <div class="list-group">
        @if ($users->count())
            @foreach ($users as $user)
            <p>{{$user}}</p>
            @endforeach
        @else
            You didn't add any places yet...
        @endif
    </div>

@endsection
