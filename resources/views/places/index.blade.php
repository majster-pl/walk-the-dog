@extends("layouts.app")

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('All Places') }}
                <div class="float-end">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-success text-white dropdown-toggle" type="button"
                            id="dropdownMenuFilter1" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by
                            @switch(Request::get('sort'))
                                @case('status')
                                    Status
                                @break

                                @case('title')
                                    Tilte
                                @break

                                @case('address_city')
                                    City
                                @break

                                @case('created_at')
                                    Newest
                                @break

                                @default
                            @endswitch
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuFilter1">
                            <li><a class="dropdown-item {{ Request::get('sort') == 'title' ? 'active' : '' }}"
                                    href="{{ route('places') . '?sort=title' }}">Title</a></li>
                            {{-- <li><a class="dropdown-item" href="{{route('places'). '?sort=likes'}}">Likes</a></li> --}}
                            <li><a class="dropdown-item {{ Request::get('sort') == 'address_city' ? 'active' : '' }}"
                                    href="{{ route('places') . '?sort=address_city' }}">City</a></li>
                            <li><a class="dropdown-item {{ Request::get('sort') == 'created_at' ? 'active' : '' }}"
                                    href="{{ route('places') . '?sort=created_at' }}">Newest</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="list-group">
                    @if ($places->count())
                        @foreach ($places as $place)
                            @include('components.placeListItem')
                        @endforeach
                    @else
                        No places added yet...
                    @endif
                    <div class="mt-3">
                        {{ $places->appends($_GET)->links() }}
                    </div>
                </div>


            </div>
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
