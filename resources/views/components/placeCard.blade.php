<div class="col-md-4 col-12 mb-4">
    <div class="card mb-2 h-100">
        <img src="{{ isset($place->main_image_path)? asset('/uploads/images/' . $place->main_image_path): asset('images/image-missing.webp') }}"
            class="card-img-top img-responsive h-100" style="height: 15rem !important; object-fit: cover;"
            alt="Main image">
        <div class="card-body">
            <h5 class="card-title text-truncate">
                {{ Str::length($place->title) > 0 ? $place->title : '[Title not set]' }}</h5>
            <p class="truncate-line-clamp mb-0">
                {{ Str::length($place->description) > 0 ? $place->description : '[Info not set]' }}</p>
        </div>
        <div class="mx-3">
            <p class="truncate-line-clamp mb-1"><i class="fa fa-location-arrow me-1 text-success" aria-hidden="true"></i> 
                {{ Str::length($place->address_city) > 0 ? $place->address_city : '[Info not set]' }}</p>
        </div>
        <div class="d-flex flex-row mx-3">
            <div>
                <span class="align-text-bottom me-2">
                    <i class="text-success fa fa-heart{{ !$place->likedBy(Auth::user()) ? '-o' : '' }} me-1"
                        aria-hidden="true"></i>
                    <span style="font-size: 0.68rem">
                        {{ $place->likes->count() }}
                    </span>
                </span>
            </div>
            @if (!$place->likedBy(Auth::user()))
                <form method="post" action="{{ route('places.likes', $place) }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-link link-secondary p-0 pe-1 text-decoration-none">Like</button>
                </form>
            @else
                <form method="post" action="{{ route('places.likes', $place) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-link link-secondary p-0 pe-1 text-decoration-none">Unlike</button>
                </form>
            @endif
        </div>
        {{-- <p class="card-text m-0 mx-3"><small class="text-muted">
                <i class="fa fa-heart{{ $place->likes->count() ? '' : '-o' }}" aria-hidden="true"></i>
                {{ $place->likes->count() }}
                {{ Str::plural('like', $place->likes->count()) }}</small></p> --}}
        <p class="card-text m-0 mx-3"><small class="text-muted">Added
                {{ $place->created_at->diffForHumans() }} by <span
                    class="fw-bold">{{ isset($place->user->name) ? $place->user->name : "Remvoed" }}</span></small></p>
        <div class="card-footer p-0 m-0">
            <a href="{{ route('place.preview', $place->id) }}"
                class="btn btn-success text-white d-block mx-0">Details</a>
        </div>
    </div>
</div>
