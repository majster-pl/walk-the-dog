@extends('layouts.app', [
'title' => 'About Page',
'description' => 'Walk The Dog was created by open source enthusiast (Szymon Waliczek) to help people explore new and
beautiful places where they can take their pets for a walk and play with them. This is a side project developed to
improve my skills with Laravel framework and at the same time create something useful for others.',
'og_image' => asset('images/about.jpg')
])

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('About') }}</div>
            <div class="card-body">
                {{-- general --}}
                <h5 class="text-uppercase fw-light">General</h5>
                <p class="fs-6 m-2">
                    <span class="fw-bold">Walk The Dog</span> is an <a
                        href="https://opensource.com/resources/what-open-source" target="_blank" rel="noreferrer">open
                        source</a> project created by <a href="https://waliczek.org" target="_blank" rel="noreferrer">Szymon
                        Waliczek</a> to help people
                    explore new places, where they can take their four-legged pets for a walk. This is a side project
                    created in free time to upskill knowledge about <a href="https://laravel.com" target="_blank"
                        rel="noreferrer">Laravel framework</a> and at the same time create something useful, handy and
                    accessible for everyone.
                </p>
                <p class="fs-6 m-2">
                    Version 1.0 was released in May 2022 and the source code is available on <a href="https://github.com/majster-pl/walk-the-dog" target="_blank"
                        rel="noreferrer">github <i class="fa fa-github" style="font-size: 1.0rem" aria-hidden="true"></i></a>.
                </p>
                <p class="fs-6 m-2 pb-2">
                    Development of this project will be continued and improved if there will be reasonably high interest.
                </p>

                {{-- contribution --}}
                <h5 class="pt-2 text-uppercase fw-light">Contributing</h5>
                <ul class="list-unstyled mx-2 pb-2">
                    <li class="fw-bold">Adding new places</li>
                    <ul>
                        <li>The easiest way to contribute is by adding new places to our collection.
                        </li>
                        <li>
                            It's a very simple process and only takes 2 minutes!
                        </li>
                        <li>
                            <a href="{{ route('register') }}">Sign up</a> and you're ready to go!

                        </li>
                        <li>
                            If you get stuck please feel free to <a href="{{ route('contact') }}">contact</a> me for any
                            help.
                        </li>
                    </ul>

                    <li class="fw-bold mt-2">Becomming editor</li>
                    <ul>

                        <li>If you want to help to maintain this site by reviewing newly added places or editing/updating
                            information, please feel free to drop me an message via <a
                                href="{{ route('contact', 'editor') }}">contact</a> form with brief information about
                            yourself and
                            why you want to become an editor. I'll review your request and respond to it as soon as possible
                            so you can start contributing without delays.</li>
                    </ul>

                    <li class="fw-bold mt-2">Development & Design</li>
                    <ul>
                        <li>If you are a developer or designer who wants to help to improve this project please feel free to
                            submit your proposal changes on official
                            <a href="https://github.com/majster-pl" target="_blank" rel="noreferrer">
                                github <i class="fa fa-github" style="font-size: 1.0rem" aria-hidden="true"></i></a>
                            page or <a href="{{ route('contact') }}">contact</a> me directly to disuse any feature changes
                            to this project..

                        </li>
                    </ul>

                </ul>
                {{-- donation --}}
                <h5 class="pt-2 text-uppercase fw-light">Donations</h5>
                <p class="text-danger mx-2">This is completely <span class="fw-bold">non-profit</span> service and
                    this is why I ask good people to donate to keep this site a life as hosting and domain need founding for
                    this site to exist. I'll update information on this page with the list of contributors and contributors
                    unless you want to stay anonymous.</p>

                <div id="donate-button-container">
                    <div class="ps-2" id="donate-button"></div>
                    <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
                    <script>
                        PayPal.Donation.Button({
                            env: 'production',
                            hosted_button_id: '3DSFTB3TNBPSY',
                            image: {
                                src: 'https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif',
                                alt: 'Donate with PayPal button',
                                title: 'PayPal - Donate to my project to keep it alive!',
                            }
                        }).render('#donate-button');
                    </script>
                </div>

            </div>
        </div>
    </div>
@endsection
