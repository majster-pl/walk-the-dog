@extends("layouts.app")
@section('content')
    <div class="intro-bg-image text-black w-100 m-0 p-0">
        <div>
            <svg class="intro-bg-bottom-wave" viewBox="0 0 1440 100">
                <path fill="#f8fafc" fillOpacity="1" 
                d="M0,85L1440,1L1440,100L0,100Z"
                ></path>
            </svg>
        </div>
        <div class="container py-4 text-white">
            <p class="display-4 pt-3">Welcome to Walk The Dog!</p>
            <p class="display-6">You can find here places near you to walk your pet!</p>
            <p class="lead">Please contribute by sharing with us <a class="link-white" href="{{ route('add-new-place') }}">new places</a> where you like to walk your dog :)</p>
        </div>
    </div>
    <div class="container pb-5 pt-2">
        <h3 class="">Recently Added</h3>
        @if ($recent->count())
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
        @else
            <div style="height: 13rem">
                <span class="">No places added yet, be the first to <a class="btn btn-sm btn-success"
                        href="{{ route('add-new-place') }}">add new</a> place!</span>
            </div>
        @endif

        <h3 class="">Top Rated</h3>
        @if ($top->count())
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
        @else
            <div style="height: 13rem">
                <span class="">No rated places yet, be the first to <a class="btn btn-sm btn-success"
                        href="{{ route('places') }}">like</a> place!</span>
            </div>
        @endif
    </div>
@endsection
