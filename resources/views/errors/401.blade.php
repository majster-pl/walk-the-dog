@extends('layouts.app', ['title' => 'Search results for: "'. Request::get('search'). '"' ])

@section('content')
    <div class="container pb-5 pt-4">
        <h1>401 Not Authorised</h1>
        <hr class="mt-0">
        <div>
            <p class="lead fs-4">You are not authorised to access this page.</p>
            <a class="btn btn-success text-white fw-bold" href="{{ route('home') }}">Take me back to homepage</a>
        </div>
    </div>
@endsection
