@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

@extends('layouts.app', ['title' => 'Search results for: "'. Request::get('search'). '"' ])

@section('content')
    <div class="container pb-5 pt-4">
        <h1>403 Forbidden</h1>
        <hr class="mt-0">
        <div>
            <p class="lead fs-4">{{__($exception->getMessage() ?: 'You are not authorised to access this page.') }} </p>
        </div>
    </div>
@endsection
