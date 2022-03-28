<a href="#" class="list-group-item list-group-item-action" aria-current="true">
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
                        <button type="submit" class="btn btn-link p-0 pe-1 text-decoration-none">Like</button>
                    </form>
                @else
                    <form method="post" action="{{ route('places.likes', $place) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link p-0 pe-1 text-decoration-none">Unlike</button>
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
                    @auth
                        <div class="row gx-2 justify-content-end h-100 py-1">
                            @if (auth()->user()->hasrole('super-user|editor') || $place->isUsersPost(Auth::user()))
                            <div class="col-auto mt-auto pt-2">
                                <form method="get" action="{{ $place->status !== 'pending' ? route('place.edit', $place) : route('place.review', $place) }}">
                                    @csrf
                                    @if ($place->status !== 'pending')
                                        <button class="btn btn-info text-white" type="submit">Edit</button>
                                    @else
                                        <button class="btn btn-info text-white" type="submit">Review</button>
                                    @endif
                                    </form>
                                </div>
                                @unlessrole('user')
                                    <div class="col-auto mt-auto pt-2">
                                        <form method="post" action="{{ route('places.delete', $place) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger text-white" type="submit"
                                                onClick='return confirmSubmit()'>Remove</button>
                                        </form>
                                    </div>
                                    @if ($place->status !== 'pending')
                                        <div class="col-auto mt-auto pt-2">

                                            @if ($place->status === 'published')
                                                <form method="post" action="{{ route('places.unpublish', $place) }}">
                                                    @method('PATCH')
                                                    @csrf
                                                    <button type="submit" class="btn btn-success text-white">Unpublish</button>
                                                @else
                                                    <form method="post" action="{{ route('places.publish', $place) }}">
                                                        @method('PATCH')
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-success text-white">Publish</button>
                                            @endif
                                            </form>
                                        </div>
                                    @endunlessrole
                                @endif
                        </div>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>
</a>
