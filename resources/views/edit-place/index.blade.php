@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a class="btn btn-success mb-3 text-white" href="{{ URL::previous() }}">Back</a>

        <div class="card">
            <div class="card-header fs-5">{{ __('Edit Place') }}</div>
            <div class="card-body">
                @if ($access)
                    @include('components.add-edit-place-form')
                @else
                    <p class="fs-4 text-danger">
                        You do not have privileges to edit this post!
                    </p>
                    <p>If you want to become an editor please contact admin via <a
                            href="mailto:waliczek.szymon@gmail.com">email</a>.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
