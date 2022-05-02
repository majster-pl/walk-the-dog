@extends('layouts.app', ['title' => 'Add new place', 'description' => 'You can help others find new places by adding new places to our collection.'])

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('Add New Place') }}</div>
            <div class="card-body">
                @include('components.add-edit-place-form', ['page' => 'add'])
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
