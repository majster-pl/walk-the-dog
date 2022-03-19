@extends("layouts.app")
@section('content')
    <div class="intro-bg-image text-black w-100 m-0 p-0 unselectable">
        <svg class="intro-bg-bottom-wave" viewBox="0 0 1440 319">
            <path fill="#f8fafc" fillOpacity="1" {{-- d="M0,128L80,128C160,128,320,128,480,149.3C640,171,800,213,960,197.3C1120,181,1280,107,1360,69.3L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z" --}} {{-- d="M0,96L120,122.7C240,149,480,203,720,202.7C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z" --}} {{-- d="M0,96L120,90.7C240,85,480,75,720,112C960,149,1200,235,1320,277.3L1440,320L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z" --}}
                d="M0,256L1440,128L1440,320L0,320Z"></path>
        </svg>
        <div class="container py-4 text-white">
            <h1 class="pt-3">Welcome to Walk The Dog!</h1>
            <h3>You can find here a new place nearby to walk you pet!</h3>
            <p>Please fell free to contribute and share with us a new place where you like to walk your dog :)</p>
        </div>
    </div>
    <div class="container pb-5">
        <h4>Recently added</h4>
        <div class="row text-center">
            <div class="col-md-4 col-12">
                <div class="card my-2 h-100">
                    <img src="{{ asset('images/me.jpg') }}" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-success">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card my-2 h-100">
                    <img src="{{ asset('images/me.jpg') }}" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-success">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card my-2 h-100" >
                    <img src="{{ asset('images/me.jpg') }}" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-success">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
