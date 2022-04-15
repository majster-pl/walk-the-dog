@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header fs-4">{{ __('Contact') }}</div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-12 col-md-8">
                        <p class="fs-5">If you have any queries please contact me by completing below form and I'll
                            get back to you as soon as possible.</p>
                        <form action="{{ route('contact') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">

                                <input type="text" class="form-control @error('name') is-invalid @enderror"" name=" name"
                                    id="ContactInputName" value="{{ old('name') }}" placeholder="Jan Kowalski">
                                <label class="text-secondary" for="ContactInputName">Your Name</label>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">

                                <input type="text" class="form-control @error('email') is-invalid @enderror"" name=" email"
                                    id="ContactInputEmail" value="{{ old('email') }}" placeholder="name@example.com">
                                <label class="text-secondary" for="ContactInputEmail">Your e-mail address</label>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('message') is-invalid @enderror"" name=" message" placeholder="Enter your message"
                                    id="ContactInputMessage" style="height: 150px">{{old('message')}}</textarea>
                                <label class="text-secondary" for="ContactInputMessage">Message</label>
                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <small>If you want to <span class="text-success fw-bold">become an editor</span> please tick
                                    "request editor" box below and write a bit about yourself and why you want to become an
                                    editor, I'll reveiw your request as soon as posibble.</small>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input rounded-3" name="editorRequest" type="checkbox" id="ContactInputEditorRequest">
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