@extends('layouts.app', [
'title' => 'List of all places available in our collection',
'description' => 'Here you will find a list most liked placese where you can walk your dog.',
'og_image' => asset('images/all-places.jpg')
])

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('All Places') }}
                <div class="float-end">
                    @if ($places->count() > 1)
                        @include('components.sotr-dropdown')
                    @endif
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
