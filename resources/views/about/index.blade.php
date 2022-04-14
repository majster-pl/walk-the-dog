@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('About') }}</div>
            <div class="card-body">
                <h5 class="border-bottom text-uppercase fw-light">General</h5>
                <p class="fs-6"><span class="fw-bold">Walk The Dog</span> was created by open source
                    enthusiast (<a href="https://waliczek.org" target="_blank" rel="noreferrer">Szymon Waliczek</a>) to help
                    people explore new and beautiful
                    places where they can take their pets for a walk and play with them. This is a side project developed to
                    improve my skills with Laravel framework and at the same time create something useful for others.
                    Version 1.0 is planned to be released in May 2022. If project will attract satisfing number of users
                    Szymon will contine to improve this site.
                </p>
                <h5 class="border-bottom text-uppercase fw-light">Contribution</h5>
                <ul class="list-unstyled">
                    <li class="fw-bold">Adding new places</li>
                    <ul>
                        <li>If you want to contribut by adding new pleaces, it's very simple! Just regrister and start
                            adding new places, it is very simple proccess but if you get stuck at any stage please fill free
                            to <a href="{{ route('contact') }}">contact me</a>.</li>
                        <li>will still show a bullet</li>
                        <li>and have appropriate left margin</li>
                    </ul>

                    <li class="fw-bold">Becomming editor</li>
                    <ul>

                        <li>If you want to help maintaining this site by reviewing newely added places or editing/updating
                            informations please feel free to <a href="{{ route('contact') }}">contact me</a> with brief inforamtion about yourself and why you
                            want to become an editior and I'll review your request as soon as possible to allow you to satrt
                            contributing soon.</li>
                    </ul>

                    <li class="fw-bold">Development & Design</li>
                    <ul>
                        <li>
                            If you are a developer or designer who want to help to improve this project please feel
                            free to submit your proposal changes on oficial
                            <a href="https://github.com/majster-pl" target="_blank" rel="noreferrer">
                                github
                                <i class="fa fa-github" style="font-size: 1.0rem" aria-hidden="true"></i>
                            </a>
                            page or <a href="{{ route('contact') }}">contact me</a> dorectly.

                        </li>
                    </ul>

                </ul>

                <h5 class="border-bottom text-uppercase fw-light">Donations</h5>
                <p>This project is completaly proffit free this is why I ask good people to donate to keep this site a life
                    as hosting and domain need founding for this site to exists. I'll update inforamtion on this page with
                    the list of donators and contributors unless you want to stay anonymouse.</p>

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
                                title: 'PayPal - The safer, easier way to pay online!',
                            }
                        }).render('#donate-button');
                    </script>
                </div>

            </div>
        </div>
    </div>
@endsection
