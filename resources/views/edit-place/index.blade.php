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
            <div class="card-header fs-5">{{ __('Edit Place') }}</div>
            <div class="card-body">
                @if ($access)
                    <form class="my-3" action="/place/edit" method="post">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" name="id" value="{{ $place->id }}">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" placeholder="Title" value="{{ old('title') ?? $place->title }}">
                            <label for="title">Title</label>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                                name="location" placeholder="Place location"
                                value="{{ old('location') ?? $place->location }}">
                            <label for="location">Location</label>
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('info') is-invalid @enderror" placeholder="Information about place" id="info"
                                name="info" style="height: 100px">{{ old('info') ?? $place->info }}</textarea>
                            <label for="info">Information</label>
                            @error('info')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            @if (Auth::user()->can('publish places'))
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="publishedCheckbox" name="status"
                                        {{ $place->status === 'published' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="publishedCheckbox"
                                        title="Only Editors and Admins can publish places, if you are not editor your place will be pending review.">Published</label>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-success text-white float-end">Update</button>
                        </div>
                    </form>
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
