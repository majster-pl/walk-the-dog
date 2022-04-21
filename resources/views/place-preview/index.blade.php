@extends('layouts.app', [
'title' => $place->title,
'description' => $place->description,
'og_image' => isset($place->main_image_path)? asset('/uploads/images/' . $place->main_image_path) :
asset('images/logo-full.png')
])

@section('content')
    <div class="container py-2">

        <a class="link-success" href="{{ url()->previous() }}">back</a>

        @if ($place->count())
            <div class="card mt-2">
                <div class="card-header">
                    <span class="fs-4">
                        {{ $place->title }} <span
                            class="text-danger">{{ $place->status == 'pending' ? '  (Pending review...)' : '' }}</span>
                    </span>
                    @hasrole('super-user|editor')
                        <form class="float-end" method="get" action="{{ route('place.edit', $place) }}">
                            @csrf
                            <button class="btn btn-sm btn-info text-white fw-bold" type="submit">Edit</button>
                        </form>
                    @elseif ($place->isUsersPost(Auth::user()))
                        <form class="float-end" method="get" action="{{ route('place.edit', $place) }}">
                            @csrf
                            <button class="btn btn-sm btn-info text-white fw-bold" type="submit">Edit</button>
                        </form>
                    @endhasrole
                </div>
                <div class="card-body {{ $place->status == 'pending' ? 'opacity-50 unselectable' : '' }}">
                    <div class="row">
                        <div class="col col-12 col-md-8">
                            <img src="{{ isset($place->main_image_path)? asset('/uploads/images/' . $place->main_image_path): asset('images/image-missing.webp') }}"
                                class="img-fluid mb-1 me-3 float-sm-start"
                                style="min-height: 14rem; max-height: 20rem; width: 100%; object-fit: cover;"
                                alt="Main Image">
                            <span class="fs-5">About:</span>
                            <p class="text-break">{{ $place->description }}
                        </div>
                        <div class="col col-12 col-md-4 border-start ">
                            <div class="row">
                                <div class="col-12 my-2">
                                    <iframe class="border" width="99%" id="gmap_canvas"
                                        src="{{ 'https://maps.google.com/maps?q=' . $place->address_latitude . '&t=&z=17&ie=UTF8&iwloc=&output=embed' }}"
                                        frameborder="1" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                </div>
                                <div class="col-12 mb-3">
                                    <span class="fs-5">Address:</span>
                                    <ul class="list-unstyled mb-1">
                                        <li>{{ $place->address_line1 }}</li>
                                        <li>{{ $place->address_line2 }}</li>
                                        <li>{{ $place->address_state_or_region . ', ' . $place->address_city }}</li>
                                        <li>{{ $place->address_postcode_or_zip }}</li>
                                        <li>{{ $place->address_country }}</li>
                                    </ul>
                                    <a class="btn btn-success text-white fw-bold w-100"
                                        href="{{ 'https://www.google.com/maps/place/' . $place->address_latitude }}"
                                        target="_blank" rel="noreferrer">Navigate</a>
                                </div>
                                {{-- <div class="col-12 mb-2">
                                    <span class="fs-5">Weather forcast:</span>

                                </div> --}}
                                <div class="col-12 mb-2">
                                    <span class="fs-5">Additional information:</span>
                                    <div class="row row-cols-2">
                                        <div class="col">Walk time: <span class="fw-bold">
                                                {{ $place->walk_time }}h </span></div>

                                        <div class="col">Type: <span class="fw-bold">
                                                {{ $place->placeType->name }} </span></div>
                                        <div class="col">Activity:
                                            @switch($place->activity)
                                                @case(1)
                                                    <span class="fw-bold text-success">Low</span>
                                                @break

                                                @case(2)
                                                    <span class="fw-bold text-warning">Medium</span>
                                                @break

                                                @case(3)
                                                    <span class="fw-bold text-danger">High</span>
                                                @break

                                                @default
                                                    Medium
                                            @endswitch
                                        </div>
                                        <div class="col">Dogs only: <span>
                                                <i class="fa fa-{{ $place->dogs_only ? 'check text-success' : 'times text-danger' }}"
                                                    aria-hidden="true"></i></span></div>
                                        <div class="col">No lead: <span>
                                                <i class="fa fa-{{ $place->off_lead ? 'check text-success' : 'times text-danger' }}"
                                                    aria-hidden="true"></i></span></div>
                                        <div class="col">Cafe nearby: <span>
                                                <i class="fa fa-{{ $place->cafe_access ? 'check text-success' : 'times text-danger' }}"
                                                    aria-hidden="true"></i></span></div>
                                        <div class="col">Water access: <span>
                                                <i class="fa fa-{{ $place->access_to_water ? 'check text-success' : 'times text-danger' }}"
                                                    aria-hidden="true"></i> </span></div>
                                        <div class="col">Disposal bins: <span>
                                                <i class="fa fa-{{ $place->disposal_bins ? 'check text-success' : 'times text-danger' }}"
                                                    aria-hidden="true"></i></span></div>
                                    </div>
                                    <div class="col">Parking: <span>
                                            <i class="fa fa-{{ $place->parking ? 'check text-success' : 'times text-danger' }}"
                                                aria-hidden="true"></i>
                                        </span>
                                        <span
                                            style="font-size: 0.8rem">{{ $place->parking_details ? $place->parking_details : ' (details missing)' }}</span>
                                    </div>

                                    <div class="col">Seasonal access: <span class="fw-bold">
                                            <i class="fa fa-{{ $place->seasonal_access ? 'check text-success' : 'times text-danger' }}"
                                                aria-hidden="true"></i></span>
                                        <span
                                            style="font-size: 0.8rem">{{ $place->seasonal_details ? $place->seasonal_details : ' (details missing)' }}</span>
                                    </div>
                                    <div class="col mt-2">
                                        <div class="d-flex flex-row ">
                                            <div>
                                                <span class="align-text-bottom me-2">
                                                    <i class="text-success fa fa-heart{{ !$place->likedBy(Auth::user()) ? '-o' : '' }} me-1"
                                                        aria-hidden="true"></i>
                                                    <span style="font-size: 0.68rem">
                                                        {{ $place->likes->count() }}
                                                    </span>
                                                </span>
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
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                {{-- <hr class="mx-3 my-2"> --}}
                <div class="card-body pt-0  {{ $place->status == 'pending' ? 'opacity-50 unselectable' : '' }}">
                    <span class="fs-5">Pictures</span>
                    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3 pt-2">
                        <div class="col text-center">
                            <img class="img-fluid" src="https://picsum.photos/300/200"
                                style="width: 100%; height: 100%" alt="">
                        </div>
                        <div class="col text-center">
                            <img class="img-fluid" src="https://picsum.photos/300/250"
                                style="width: 100%; height: 100%" alt="">
                        </div>
                        <div class="col text-center">
                            <img class="img-fluid" src="https://picsum.photos/300/210"
                                style="width: 100%; height: 100%" alt="">
                        </div>
                        <div class="col text-center">
                            <img class="img-fluid" src="https://picsum.photos/300/270"
                                style="width: 100%; height: 100%" alt="">
                        </div>
                        <div class="col text-center">
                            <img class="img-fluid" src="https://picsum.photos/200/200"
                                style="width: 100%; height: 100%" alt="">
                        </div>
                    </div>
                </div>

                <div class="card-body d-none">
                    <span class="fs-5">Comments</span>
                    <div class="row-col-12">
                        <div class="card">
                            <div class="col">
                                <div class="card-body border-bottom">
                                    <p class="card-title">User 1 - <span class="text-secondary">10h</span></p>
                                    <p class="card-text ms-2">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                </div>
                                <div class="card-body border-bottom">
                                    <p class="card-title">User 1 - <span class="text-secondary">10h</span></p>
                                    <p class="card-text ms-2">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                </div>
                                <div class="card-body border-bottom">
                                    <p class="card-title">User 1 - <span class="text-secondary">10h</span></p>
                                    <p class="card-text ms-2">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @php
                // dd($place->likedByMe);
            @endphp
        @else
            @include('layouts.404')
        @endif
    </div>
@endsection
