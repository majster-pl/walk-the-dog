@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('About') }}</div>
            <div class="card-body">
                <h5 class="text-uppercase fw-light">General</h5>
                <p class="fs-6 mx-2"><span class="fw-bold">Walk The Dog</span> was created by open source
                    enthusiast (<a href="https://waliczek.org" target="_blank" rel="noreferrer">Szymon Waliczek</a>) to help
                    people explore new and beautiful
                    places where they can take their pets for a walk and play with them. This is a side project developed to
                    improve my skills with Laravel framework and at the same time create something useful for others.
                    Version 1.0 is planned to be released in May 2022. Should this project attract satisfing number of users
                    I'll contine to work on it to improve it and add new features.
                </p>
                <h5 class="border-top pt-2 text-uppercase fw-light">Contribution</h5>
                <ul class="list-unstyled mx-2">
                    <li class="fw-bold">Adding new places</li>
                    <ul>
                        <li>The easiest way to contribute is by start adding new places, it's very simple process and it
                            takes less then 2 minutes! Just create new account and you are good to go. If you get stuck at
                            any stage please fill free to
                            <a href="{{ route('contact') }}">contact</a> me for help.
                        </li>
                    </ul>

                    <li class="fw-bold">Becomming editor</li>
                    <ul>

                        <li>If you want to help to maintain this site by reviewing newly added places or editing/updating
                            information, please feel free to drop me an message via <a
                                href="{{ route('contact') }}">contact</a> form with brief information about yourself and
                            why you want to become an editor. I'll review your request and respond to it as soon as possible
                            so you can start contributing without delays.</li>
                    </ul>

                    <li class="fw-bold">Development & Design</li>
                    <ul>
                        <li>If you are a developer or designer who wants to help to improve this project please feel free to
                            submit your proposal changes on official
                            <a href="https://github.com/majster-pl" target="_blank" rel="noreferrer">
                                github <i class="fa fa-github" style="font-size: 1.0rem" aria-hidden="true"></i></a>
                            page or <a href="{{ route('contact') }}">contact me</a> directly to disuse any feature changes to this project..

                        </li>
                    </ul>

                </ul>

                <h5 class="border-top pt-2 text-uppercase fw-light">Donations</h5>
                <p class="text-danger mx-2">This is completely <span class="fw-bold">non-profit</span> service and this is why I ask good people to donate to keep this site a life as hosting and domain need founding for this site to exist. I'll update information on this page with the list of contributors and contributors unless you want to stay anonymous.</p>

                <div id="donate-button-container">
                    <div id="donate-button"></div>
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
