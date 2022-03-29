<div class="col-md-4 col-12 mb-4">
    <div class="card mb-2 h-100">
        <img src="{{ asset('images/dog1.webp') }}" class="card-img-top img-fluid" alt="...">
        <div class="card-body">
            <h5 class="card-title">
                {{ Str::length($place->title) > 0 ? $place->title : '[Title not set]' }}</h5>
            <p class="card-text">
                {{ Str::length($place->info) > 0 ? $place->info : '[Info not set]' }}</p>
        </div>
        <p class="card-text m-0 mx-3"><small class="text-muted">
                {{ $place->likes->count() }}
                {{ Str::plural('like', $place->likes->count()) }}</small></p>
        <p class="card-text m-0 mx-3"><small class="text-muted">Added
                {{ $place->created_at->diffForHumans() }}</small></p>
        <div class="card-footer p-0 m-0">
            <a href="#" class="btn btn-success d-block mx-0 rounded-0">Details</a>
        </div>
    </div>
</div>
