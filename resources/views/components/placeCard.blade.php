<div class="col-md-4 col-12 mb-4">
    <div class="card mb-2 h-100">
        <img src="{{ isset($place->main_image_path)? asset('/uploads/images/' . $place->main_image_path): asset('images/image-missing.webp') }}"
            class="card-img-top img-responsive h-100" style="height: 15rem !important; object-fit: cover;" alt="Main image">
        <div class="card-body">
            <h5 class="card-title text-truncate">
                {{ Str::length($place->title) > 0 ? $place->title : '[Title not set]' }}</h5>
            <p class="truncate-line-clamp mb-0">
                {{ Str::length($place->description) > 0 ? $place->description : '[Info not set]' }}</p>
        </div>
        <p class="card-text m-0 mx-3"><small class="text-muted">
                {{ $place->likes->count() }}
                {{ Str::plural('like', $place->likes->count()) }}</small></p>
        <p class="card-text m-0 mx-3"><small class="text-muted">Added
                {{ $place->created_at->diffForHumans() }}</small></p>
        <div class="card-footer p-0 m-0">
            <a href="{{ route('place.preview', $place->id) }}" class="btn btn-success d-block mx-0">Details</a>
        </div>
    </div>
</div>
