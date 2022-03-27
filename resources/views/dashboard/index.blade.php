@extends("layouts.dashboard")
@section('content-card-title')
    Places added by you
@endsection
@section('content-card')
    <div class="list-group">
        @if ($places->count())
            @foreach ($places as $place)
                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <h5 class="mb-1">
                                {{ Str::length($place->title) > 0 ? $place->title : '[Title not set]' }}</h5>
                            <p class="mb-1">{{ $place->info }}</p>
                            <div class="d-flex flex-row ">
                                <div>
                                    <span class="align-text-bottom me-2">{{ $place->likes->count() }}
                                        {{ Str::plural('like', $place->likes->count()) }}</span>
                                </div>
                                @if (!$place->likedBy(Auth::user()))
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
                                <small class="me-2">{{ $place->created_at->diffForHumans() }}
                                </small> <small
                                    class="text-{{ $place->isPublic() ? 'success' : 'warning' }} fw-bold">{{ $place->status }}</small>
                            </div>
                            @if ($place->isUsersPost(Auth::user()))
                                <div class="col-12">
                                    <div class="d-flex justify-content-end">
                                    <form method="get" action="{{ route('place.edit', $place) }}">
                                        <button class="btn btn-link me-2" type="submit">Edit</button>
                                    </form>
                                        <button class="btn btn-danger" disabled>Remove</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            You didn't add any places yet...
        @endif
        <div class="mt-3">
            {{ $places->links() }}
        </div>
    </div>

@endsection
