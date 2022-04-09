@extends("layouts.dashboard")
@section('content-card-title')
    <span class="fs-4">
        All places
    </span>
    <div class="float-end">
        @include('components.sotr-dropdown')
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
