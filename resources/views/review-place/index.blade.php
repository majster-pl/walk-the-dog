@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a class="btn btn-success mb-3 text-white" href="{{ URL::previous() }}">Back</a>
        @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! \Session::get('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header fs-5">{{ __('Review Place') }}</div>
            <div class="card-body">
                @include('components.add-edit-place-form')

            </div>
        </div>
    </div>
@endsection
