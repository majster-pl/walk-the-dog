@extends('layouts.app', ['title' => 'Review Place: '. $place->title])

@section('content')
    <div class="container">
        <div class="alert mt-4 alert-warning alert-dismissible fade show mb-0" role="alert">
            <h5>Dear Editor!</h5>
            Please check all details carefully for:
            <ul>
                <li>"Bad words"</li>
                <li>Not appropriate pictures</li>
                <li>Provided information is correct</li>
                <li>Spelling or grammar error</li>
            </ul>
            Finally if you are happy with it click <strong>publish</strong> button at the bottom of that page.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="container py-2">
        <a class="link-success" href="{{ URL::previous() }}">Go Back</a>
        <div class="card mt-2">
            <div class="card-header fs-5">{{ __('Review Place') }}
                <span class="float-end" style="font-size: .8rem">Status: <b>{{ $place->status }}</b></span>
            </div>
            <div class="card-body">
                @livewire('place-edit-form', ['place' => $place, 'placeTypes' => $placeTypes, 'page' => 'review'])
            </div>
        </div>
    </div>
@endsection
