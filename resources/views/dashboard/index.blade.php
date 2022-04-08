@extends("layouts.dashboard")
@section('content-card-title')
    Places added by you
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
            {{ $places->links() }}
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
