@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a class="btn btn-success mb-3 text-white" href="{{ URL::previous() }}">Back</a>
        <div class="card">
            <div class="card-header fs-5">{{ __('Review Place') }}</div>
            <div class="card-body">
                @include('components.add-edit-place-form')

            </div>
        </div>
    </div>
@endsection
