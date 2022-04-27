<div class="col-md-4 col-12 mb-4">
    <a class="h-100 list-group-item-action card m-0 p-0 text-decoration-none" aria-current="true"
        href="{{ route('place.preview', $place->slug) }}">
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
            <p class="truncate-line-clamp mb-1"><i class="fa fa-location-arrow me-1 text-success"
                    style="font-size: 1.1rem" aria-hidden="true"></i>
                {{ Str::length($place->address_city) > 0 ? $place->address_city : '[Info not set]' }}</p>
        </div>
        @livewire('place-like-component', ['place' => $place])
        {{-- <div class="d-flex flex-row mx-3 mb-2">
            <div>
                <span class="align-text-bottom me-1">
                    <i class="text-success fa fa-heart{{ !$place->likedBy(Auth::user()) ? '-o' : '' }} me-1"
                        aria-hidden="true"></i>
                    <span style="font-size: 0.85rem">
                        {{ $place->likes->count() }}
                    </span>
                </span>
            </div>
            @if (!$place->likedBy(Auth::user()))
                <form method="post" action="{{ route('places.likes', $place) }}">
                    @csrf
                    <button type="submit" style="position: relative; z-index:3"
                        class="btn link-primary p-0 pe-1 text-decoration-underline">Like</button>
                </form>
            @else
                <form method="post" action="{{ route('places.likes', $place) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="position: relative; z-index:3"
                        class="btn link-primary p-0 pe-1 text-decoration-underline">Unlike</button>
                </form>
            @endif
        </div> --}}
        <div class="card-footer px-0">

            <p class="card-text m-0 mx-3"><small class="text-muted">Added
                    {{ $place->created_at->diffForHumans() }} by <span
                        class="fw-bold">{{ isset($place->user->name) ? $place->user->name : 'Remvoed' }}</span></small>
            </p>
        </div>
    </a>
</div>
