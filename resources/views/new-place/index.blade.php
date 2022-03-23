@extends("layouts.app")

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-5">{{ __('Add New Place') }}</div>
            <div class="card-body">

                <form class="my-3" action="{{ route('add-new-place') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                            placeholder="Title" value="{{ old('title') }}">
                        <label for="title">Title</label>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" placeholder="Place location" value="{{ old('location') }}">
                        <label for="location">Location</label>
                        @error('location')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('info') is-invalid @enderror" placeholder="Information about place" id="info"
                            name="info" style="height: 100px">{{ old('info') }}</textarea>
                        <label for="info">Information</label>
                        @error('info')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="publishedCheckbox" name="published" {{ Auth::user()->can('publish places') ? "checked" : ''}} {{ Auth::user()->can('publish places') ? "" : 'disabled'}}>
                            <label class="form-check-label" for="publishedCheckbox" title="Only Editors and Admins can publish places, if you are not editor your place will be pending review.">Publish when submitted</label>
                        </div>
                        <button type="submit" class="btn btn-success float-end">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
