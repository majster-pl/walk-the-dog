@extends('layouts.app')

@section('content')
    <div class="container pb-5 pt-4">
        <h3>Search results @if ($recent->count())
                for: "{{ Request::get('search') }}"
            @endif
        </h3>
        <hr class="mt-0">
        @if ($search->count())
            <div class="row pb-3">
                @foreach ($recent as $place)
                    @include('layouts.placeCard')
                @endforeach
            </div>
        @else
            <div>
                <h1><i class="fa fa-frown-o" aria-hidden="true"></i> Hmmm.... </h1>
                <p class="lead fs-4">We can't find any matches for "{{ Request::get('search') }}".
                </p>
                <p>
                    Double check your search for any typos or spelling errors - or try a different serach term.
                </p>
                <p>We also would like to encourage you to participate and <a class="btn-link text-success px-0 pb-1"
                        href="{{ route('add-new-place') }}">add new</a> places to our collection for others!</p>
                @if ($recent->count())
                    <div style="min-height: 5rem"></div>
                    <h3 class="">Recently added places</h3>
                    <div class="row pb-3 justify-content-evenly">
                        @foreach ($recent as $place)
                            @include('layouts.placeCard')
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

    </div>
@endsection
