@extends('layouts.app', ['title' => 'Review Place: '. $place->title])

@section('content')
    <div class="container py-2">
        <a class="link-success" href="{{ URL::previous() }}">Go Back</a>
        <div class="card mt-2">
            <div class="card-header fs-5">{{ __('Review Place') }}
                <span class="float-end" style="font-size: .8rem">Status: <b>{{ $place->status }}</b></span>
            </div>
            <div class="card-body">
                @include('components.add-edit-place-form')

            </div>
        </div>
    </div>
@endsection
