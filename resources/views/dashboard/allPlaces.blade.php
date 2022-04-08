@extends("layouts.dashboard")
@section('content-card-title')
    <span class="fs-4">
        All places
    </span>
    <div class="float-end">
        <div class="dropdown">
            <button class="btn btn-sm btn-success text-white dropdown-toggle" type="button" id="dropdownMenuFilter1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Sort by
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuFilter1">
                <li><a class="dropdown-item" href="{{ route('dashboard.all_places') . '?sort=title' }}">Title</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.all_places') . '?sort=address_city' }}">City</a>
                </li>
                <li><a class="dropdown-item" href="{{ route('dashboard.all_places') . '?sort=created_at' }}">Newest</a>
                </li>
            </ul>
        </div>

    </div>
@endsection
@section('content-card')
    <div class="list-group">
        @if ($places->count())
            @foreach ($places as $place)
                @include('components.placeListItem')
            @endforeach
        @else
            No places added yet! :-(
        @endif
        <div class="mt-3">
            {{ $places->appends($_GET)->links() }}

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
