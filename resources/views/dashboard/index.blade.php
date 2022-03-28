@extends("layouts.dashboard")
@section('content-card-title')
    Places added by you
@endsection
@section('content-card')
    <div class="list-group">
        @if ($places->count())
            @foreach ($places as $place)
            @include('layouts.placeListItem')

            @endforeach
        @else
            You didn't add any places yet...
        @endif
        <div class="mt-3">
            {{ $places->links() }}
        </div>
    </div>
    <script LANGUAGE="JavaScript">
        <!--
        function confirmSubmit() {
            var agree = confirm("Are you sure you wish to remove?");
            if (agree)
                return true;
            else
                return false;
        }
        -->
    </script>
@endsection
