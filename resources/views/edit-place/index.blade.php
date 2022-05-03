@extends('layouts.app', ['title' => 'Edit Place: '. $place->title])

@section('content')
    <div class="container py-2">
        <a class="link-success" href="{{ URL::previous() }}">Go Back</a>
        <div class="card mt-2">
            <div class="card-header fs-5">{{ __('Edit Place') }}
                <span class="float-end" style="font-size: .8rem">Status: <b>{{ $place->status }}</b></span>
            </div>
            <div class="card-body">
                @livewire('place-edit-form', ['place' => $place, 'placeTypes' => $placeTypes, 'page' => 'edit'])
            </div>
        </div>
    </div>
        <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $("[data-toggle='popover']").popover({
                    html: true
                });
            })
        });
    </script>
@endsection
