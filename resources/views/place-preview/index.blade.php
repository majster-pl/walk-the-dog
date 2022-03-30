@extends('layouts.app')

@section('content')
    <div class="container py-4">

        @if ($place->count())
            <p>{{ $place }}</p>
        @else
        @include('layouts.404')

        @endif
    </div>
@endsection
