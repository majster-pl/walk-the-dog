@extends("layouts.dashboard")
@section('content-card-title')
<span class="fs-4">

    Places added by you
</span>
    <div class="float-end">
        <div class="dropdown">
            <button class="btn btn-sm btn-success text-white dropdown-toggle" type="button" id="dropdownMenuFilter1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Sort by
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuFilter1">
                <li><a class="dropdown-item" href="{{ route('dashboard') . '?sort=title' }}">Title</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard') . '?sort=address_city' }}">City</a>
                </li>
                <li><a class="dropdown-item" href="{{ route('dashboard') . '?sort=created_at' }}">Newest</a>
                <li><a class="dropdown-item" href="{{ route('dashboard') . '?sort=status' }}">Status</a>
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
            <p>You didn't add any places yet...</p>
            <p>Add <a class="link-blue link-success" href="{{ route('add-new-place') }}">new place</a> to help us grow our
                collection :)</p>
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
