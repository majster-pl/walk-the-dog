@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('Contact') }}</div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-12 col-md-8">
                        <p class="fs-5">If you have any queries please contact me by completing below form and I'll get back to you as soon as possible.</p>
                        <form>
                            <div class="form-floating mb-3">

                                <input type="text" class="form-control" name="name" id="ContactInputName"
                                    placeholder="Jan Kowalski">
                                <label class="text-secondary" for="ContactInputName">Your Name</label>
                            </div>
                            <div class="form-floating mb-3">

                                <input type="email" class="form-control" name="emial" id="ContactInputEmail"
                                    placeholder="name@example.com">
                                <label class="text-secondary" for="ContactInputEmail">Your e-mail address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="message" placeholder="Enter your message" id="ContactInputMessage"
                                    style="height: 150px"></textarea>
                                <label class="text-secondary" for="ContactInputMessage">Message</label>
                            </div>
                            <div class="mb-3">
                                <small>If you want to <span class="text-success fw-bold">become an editor</span> please tick "request editor" box below and write a bit about yourself and why you want to become an editor, I'll reveiw your request as soon as posibble.</small>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input rounded-3" type="checkbox" id="ContactInputEditorRequest">
                                <label class="form-check-label unselectable" for="ContactInputEditorRequest">Request
                                    editor</label>
                            </div>
                            <div class="d-grid d-md-block gap-2">
                                <button type="submit" class="btn btn-success text-white float-end">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
