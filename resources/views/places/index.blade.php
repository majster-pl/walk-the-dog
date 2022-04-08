@extends("layouts.app")

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-5">{{ __('All Places') }} <div class="float-end">
                    <div class="dropdown">
                        <button class="btn btn-success text-white dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Likes</a></li>
                            <li><a class="dropdown-item" href="#">Newest</a></li>
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
                        {{ $places->links() }}
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
