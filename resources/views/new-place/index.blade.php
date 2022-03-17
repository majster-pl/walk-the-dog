@extends("layouts.app")

@section('content')
    <div class="card">
        <div class="card-header fs-5">{{ __('Add New Place') }}</div>
        <div class="card-body">

            <form class="my-3" action="{{ route('add-new-place') }}" method="post">
                @csrf
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
                    <button type="submit" class="btn btn-success float-end">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card my-4">
        <div class="card-header fs-5">{{ __('Added by you') }}</div>
        <div class="card-body">

            <div class="list-group">
                @if ($places->count())
                    @foreach ($places as $place)
                        <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <div>
                                    <h5 class="mb-1">{{ $place->location }}</h5>
                                    <p class="mb-1">{{ $place->info }}</p>
                                    <small class="text-danger">{{ $place->status }}</small>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-12 text-end">
                                        <small>{{ $place->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-link me-2" disabled>Edit</button>
                                            <button class="btn btn-danger" disabled>Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    You didn't any places yet...
                @endif
                <div class="mt-3">
                    {{$places->links()}}
                </div>
            </div>


        </div>
    </div>
@endsection
