@extends("layouts.dashboard")
@section('content-card-title')
    Places awaiting review
@endsection
@section('content-card')
    <div class="list-group">
        @if ($places->count())
            @foreach ($places as $place)
                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                    {{-- <div class="d-flex w-100 justify-content-between"> --}}
                    <div class="row">

                        <div class="col-12 col-md-8">
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
                            <div>
                                <span class="align-text-bottom me-2">Submitted by: <span
                                        class="text-muted">{{ $place->user->name }}</span></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">

                            <div class="row justify-content-end h-100">
                                <div class="col-12 text-start text-md-end">
                                    <small class="me-2">{{ $place->created_at->diffForHumans() }}
                                    </small> <small
                                        class="text-{{ $place->isPublic() ? 'success' : 'warning' }} fw-bold">{{ $place->status }}</small>
                                </div>
                                <div class="col-12">
                                    <div class="row gx-2 justify-content-end h-100 pt-2">
                                        <div class="col-auto mt-auto pt-2">
                                            <form method="get" action="{{ route('place.edit', $place) }}">
                                                @csrf
                                                <button class="btn btn-info" type="submit">Edit</button>
                                            </form>
                                        </div>
                                        <div class="col-auto mt-auto pt-2">
                                            <form method="post" action="{{ route('places.delete', $place) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger text-white" type="submit"
                                                    onClick='return confirmSubmit()'>Remove</button>
                                            </form>
                                        </div>
                                        <div class="col-auto mt-auto pt-2">
                                            @if ($place->status === 'published')
                                                <form method="post" action="{{ route('places.unpublish', $place) }}">
                                                    @method('PATCH')
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-success text-white">Unpublish</button>
                                                @else
                                                    <form method="post" action="{{ route('places.publish', $place) }}">
                                                        @method('PATCH')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-success text-white">Publish</button>
                                            @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- </div> --}}
                </a>
            @endforeach
        @else
            Perfect! No places padning review! :)
        @endif
        <div class="mt-3">
            {{ $places->links() }}
        </div>
    </div>
    <script LANGUAGE="JavaScript">
        <!--
        function confirmSubmit() {
            var agree = confirm("Are you sure you want to remove?");
            if (agree)
                return true;
            else
                return false;
        }
        -->
    </script>

@endsection
