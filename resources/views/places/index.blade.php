@extends("layouts.app")

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-5">{{ __('All Places') }}</div>
            <div class="card-body">

                <div class="list-group">
                    @if ($places->count())
                        @foreach ($places as $place)

                        @include('layouts.placeListItem')

                        @endforeach
                    @else
                        No places added yet...
                    @endif
                    <div class="mt-3">
                        {{ $places->links() }}
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
