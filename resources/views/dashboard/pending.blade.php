@extends("layouts.dashboard", ['title' => 'Places awaiting review'])
@section('content-card-title')
    <span class="fs-4">
        Places awaiting review
    </span>
    <div class="float-end">
        @if ($places->count() > 1)
            @include('components.sotr-dropdown')
        @endif
    </div>
@endsection
@section('content-card')
    <div class="list-group">
        @if ($places->count())
            @foreach ($places as $place)
                @include('components.placeListItem')
            @endforeach
        @else
            Perfect! No places padning review! :)
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
