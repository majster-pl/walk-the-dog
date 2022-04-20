<a href="{{ route('place.preview', isset($place->slug) ? $place->slug : $place->id) }}"
    class="list-group-item list-group-item-action mb-3 border position-relative" aria-current="true">
    @if ($place->isUsersPost(Auth::user()))
        
    <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-warning" style="transform: rotate(-15deg) !important;">
        Added by you
    </span>
    @endif
    <div class="row mt-2 mt-md-0">
        <div class="col col-md-2">
            <img src="{{ isset($place->main_image_path)? asset('/uploads/images/' . $place->main_image_path): asset('images/image-missing.webp') }}"
                class="img-fluid" style="height: 100%; width: 100%; max-height: 7rem; object-fit: cover;"
                alt="Main Image">
        </div>
        <div class="col-12 col-md-6">
            <h5 class="my-1">
                {{ Str::length($place->title) > 0 ? $place->title . ' - ' . $place->address_city : '[Title not set]' }}
            </h5>
            <p class="mb-1 truncate-line-clamp-2">{{ $place->description }}</p>
            <div class="d-flex flex-row ">
                <div>
                    <span class="align-text-bottom me-2">
                        <i class="fa fa-heart-o me-1" aria-hidden="true"></i>
                        {{ $place->likes->count() }}
                    </span>
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
                        class="text-muted">{{ isset($place->user->name) ? $place->user->name : 'Remvoed' }}</span></span>
            </div>
        </div>
        <div class="col-12 col-md-4">

            <div class="row justify-content-end h-100">
                <div class="col-12 text-start text-md-end">
                    <small class="">Created {{ $place->created_at->diffForHumans() }}
                    </small>
                    @if (Request::is('dashboard'))
                        <p>
                            <small>Status:</small> <small
                                class="text-{{ $place->isPublic() ? 'success' : 'warning' }}">{{ $place->status }}</small>
                        </p>
                    @endif
                </div>
                <div class="col-12">
                    @auth
                        <div class="row gx-2 justify-content-end h-100 py-1">
                            @if (auth()->user()->hasrole('super-user|editor') || $place->isUsersPost(Auth::user()))
                                <div class="col-auto mt-auto pt-2">
                                    <form method="get"
                                        action="{{ $place->status !== 'pending' ? route('place.edit', $place) : route('place.review', $place) }}">
                                        @csrf
                                        @if ($place->status !== 'pending' || $place->isUsersPost(Auth::user()))
                                            <button class="btn btn-info text-white" type="submit">Edit</button>
                                        @else
                                            <button class="btn btn-info text-white" type="submit">Review</button>
                                        @endif
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
                                @unlessrole('user')
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
                                    @endif
                                @endunlessrole
                            @endif
                        </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</a>
