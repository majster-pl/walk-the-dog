@extends("layouts.app")

@section('content')
    <div class="card">
        <div class="card-header fs-5">{{ __('All Places') }}</div>
        <div class="card-body">

            <div class="list-group">
                @if ($places->count())
                    @foreach ($places as $place)
                        <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <div>
                                    <h5 class="mb-1">{{ $place->location }}</h5>
                                    <p class="mb-1">{{ $place->info }}</p>
                                    <div class="d-flex flex-row ">
                                        <div>
                                            <span class="align-text-bottom me-2">{{ $place->likes->count() }}
                                                {{ Str::plural('like', $place->likes->count()) }}</span>
                                        </div>
                                        @if (!Auth::check() || !$place->likedBy(Auth::user()))
                                        <form method="post" action="{{ route('places.likes', $place) }}">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-link p-0 pe-1 text-decoration-none">Like</button>
                                        </form>
                                        @else
                                        <form method="post" action="{{ route('places.likes', $place) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-link p-0 pe-1 text-decoration-none">Unlike</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-12 text-end">
                                        <div class="position-absolute bottom-0 end-0 me-3">
                                        </div>
                                        <small>{{ $place->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <p class="text-success mb-1">{{ $place->status }}</p>
                                        </div>
                                    </div>
                                    @guest
                                    @else
                                    @if ($place->createdBy(Auth::user()))
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-link me-2" disabled>Edit</button>
                                            <button class="btn btn-danger" disabled>Remove</button>
                                        </div>
                                    </div>
                                    @endif
                                    @endguest
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    No places added yet...
                @endif
                <div class="mt-3">
                    {{ $places->links() }}
                </div>
            </div>


        </div>
    </div>
@endsection
