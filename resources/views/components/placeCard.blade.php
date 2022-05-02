<div class="col-md-4 col-12 mb-4">
    <a class="h-100 list-group-item-action card m-0 p-0 text-decoration-none" aria-current="true"
        href="{{ route('place.preview', $place->slug) }}">
        <img src="{{ isset($place->main_image_path) ? asset('place-images/' . $place->main_image_path): asset('images/image-missing.webp') }}"
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
        <div class="mx-3 mb-2">
            @livewire('place-like-component', ['place' => $place])
        </div>
        <div class="card-footer px-0">

            <p class="card-text m-0 mx-3"><small class="text-muted">Added
                    {{ $place->created_at->diffForHumans() }} by <span
                        class="fw-bold">{{ isset($place->user->name) ? $place->user->name : 'Remvoed' }}</span></small>
            </p>
        </div>
    </a>
</div>
