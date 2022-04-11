@extends("layouts.app")

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('Submission confirmation') }}</div>
            <div class="card-body">
                @if (!Session::get('success_'))
                    <span class="fs-2">Looks like something went wrong... <i class="fa fa-frown-o"
                            aria-hidden="true"></i></span>
                    <div class="row-">
                        <div class="col-12 col-md-4">
                            <img src="{{ asset('images/scared_dog.png') }}" class="img-fluid" alt="Happy dog">
                        </div>
                    </div>
                    Please try to <a class="link-success" href="{{ route('add-new-place') }}">add new place</a> again.
                @else
                    <span class="fs-2">Thank you for taking your time to submit new place <i
                            class="fa fa-smile-o" aria-hidden="true"></i></span>
                    <p class="fs-5">One of our editors will review your submittion with next 12 hours and publish
                        it so everyone can see it!</p>
                    <div class="row-">
                        <div class="col-12 col-md-4">
                            <img src="{{ asset('images/happy_dog.png') }}" class="img-fluid" alt="Happy dog">
                        </div>
                    </div>
                    <a class="btn btn-success float-end text-white" href="{{ route('add-new-place') }}">Add another</a>
                    <p>Please get <a href="{{route('contact')}}">in touch</a> if you want to become editor!</p>
                @endif
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
