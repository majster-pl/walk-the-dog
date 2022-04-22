@extends('layouts.app', ['title' => 'Edit Place: '. $place->title])

@section('content')
    <div class="container py-2">
        <a class="link-success" href="{{ URL::previous() }}">Go Back</a>
        <div class="card mt-2">
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
