@extends('layouts.app')

@section('content')
    <div class="container py-4">

        @if ($place->count())
            {{-- <h1>{{$place->title}}</h1>
            <p>{{ $place }}</p> --}}
            <div class="card">
                <div class="card-header fs-4">{{ $place->title }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col col-12 col-md-8">
                            <section class="row">
                                <div class="col">
                                    <div class="clearfix">
                                        <img src="{{ isset($place->main_image_path)? asset('/uploads/images/' . $place->main_image_path): asset('images/image-missing.webp') }}" style="width: 22rem"
                                            class="img-fluid mb-1 me-3 float-sm-start" style="min-height: 14rem; object-fit: cover;" alt="Main Image">
                                        <span class="fs-5">About:</span>

                                        <p class="">{{ $place->description }}
                                        </p>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col col-12 col-md-4 border-start pb-2">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fs-5">Map:</span>
                                </div>
                                <div class="col-12 my-2">
                                    <img src="{{ asset('images/map1.png') }}" class="card-img-top img-fluid" alt="map">

                                </div>
                                <div class="col-12">
                                    <span class="fs-5">Address:</span>
                                    <p>{{ $place->address_line1 }}</p>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success">Navigate</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                {{-- <hr class="mx-3 my-2"> --}}
                <div class="card-body pt-0">
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
        @else
            @include('layouts.404')
        @endif
    </div>
@endsection
