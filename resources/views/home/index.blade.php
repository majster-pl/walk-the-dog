@extends("layouts.app")
@section('content')
    <div class="intro-bg-image text-black w-100 m-0 p-0 unselectable">
        <svg class="intro-bg-bottom-wave" viewBox="0 0 1440 319">
            <path fill="#f8fafc" fillOpacity="1" {{-- d="M0,128L80,128C160,128,320,128,480,149.3C640,171,800,213,960,197.3C1120,181,1280,107,1360,69.3L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z" --}} {{-- d="M0,96L120,122.7C240,149,480,203,720,202.7C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z" --}} {{-- d="M0,96L120,90.7C240,85,480,75,720,112C960,149,1200,235,1320,277.3L1440,320L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z" --}}
                d="M0,256L1440,128L1440,320L0,320Z"></path>
        </svg>
        <div class="container py-4 text-white">
            <h1 class="pt-3">Welcome to Walk The Dog!</h1>
            <h3>You can find here places near you to walk your pet!</h3>
            <p>Please fell free to contribute and share with us new place where you like to walk your dog :)</p>
        </div>
    </div>
    <div class="container pb-5">
        <h3 class="text-decoration-underline">Recently Added</h3>
        <div class="row pb-3 justify-content-evenly">
            @foreach ($recent as $place)
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
                            <a href="#" class="btn btn-success d-block mx-0 rounded-0">Show me more</a>

                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <h3 class="text-decoration-underline">Top Rated</h3>
        <div class="row justify-content-evenly mb-5">
            @foreach ($top as $place)
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
                            <a href="#" class="btn btn-success d-block mx-0 rounded-0">Show me more</a>

                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
