@extends("layouts.app")

@section('content')
    <h3>Add new place</h3>
    <form class="mt-3" action="{{ route('add-new-place') }}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location"
                placeholder="Place location" value="{{ old('location') }}">
            <label for="location">Location</label>
            @error('location')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control @error('info') is-invalid @enderror" placeholder="Information about place" id="info" name="info"
                style="height: 100px">{{ old('info') }}</textarea>
            <label for="info">Information</label>
            @error('info')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-success float-end">Submit</button>
        </div>
    </form>
@endsection
