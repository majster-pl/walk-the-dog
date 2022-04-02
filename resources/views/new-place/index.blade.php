@extends("layouts.app")

@section('content')
    <div class="container py-4">
        @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! \Session::get('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header fs-5">{{ __('Add New Place') }}</div>
            <div class="card-body">

                <form class="my-3 row" action="{{ route('add-new-place') }}" method="post">
                    @csrf
                    <div class="col col-12">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" placeholder="Title" value="{{ old('title') }}" autocomplete="off">
                            <label class="text-secondary" for="title">Title <span class="text-danger">*</span></label>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- address --}}
                    <label>Address:</label>
                    <div class="col-md-8">
                        {{-- Address 1 --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('address_line1') is-invalid @enderror"
                                name="address_line1" id="address_line1" placeholder="30 Diana Garder"
                                value="{{ old('address_line1') }}">
                            <label class="text-secondary" for="address_line1" required>Address 1 <span
                                    class="text-danger">*</span></label>
                            @error('address_line1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- Address 2 --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="address_line2" id="address_line2"
                                placeholder="Downend" value="{{ old('address_line2') }}">
                            <label class="text-secondary" for="address_line2">Address 2</label>
                        </div>
                        <div class="row">
                            {{-- Town --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text"
                                        class="form-control @error('address_state_or_region') is-invalid @enderror"
                                        name="address_state_or_region" id="address_state_or_region"
                                        placeholder="Town county" value="{{ old('address_state_or_region') }}">
                                    <label class="text-secondary" for="address_state_or_region">Town <span
                                            class="text-danger">*</span></label>
                                    @error('address_state_or_region')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- City --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('address_city') is-invalid @enderror"
                                        name="address_city" id="address_city" placeholder="Town county"
                                        value="{{ old('address_city') }}">
                                    <label class="text-secondary" for="address_city">City <span
                                            class="text-danger">*</span></label>
                                    @error('address_city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- County --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('address_country') is-invalid @enderror"
                                        name="address_country" id="address_country" placeholder="Town county"
                                        value="{{ old('address_country') ? old('address_country') : 'United Kingdom' }}">
                                    <label class="text-secondary" for="address_country">Country <span
                                            class="text-danger">*</span></label>
                                    @error('address_country')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- Post Code --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="address_postcode_or_zip"
                                        id="address_postcode_or_zip" placeholder="Town county"
                                        value="{{ old('address_postcode_or_zip') }}">
                                    <label class="text-secondary" for="address_postcode_or_zip">Post Code</label>
                                </div>
                            </div>
                            <label>Coordinates: <button type="button"
                                    class="fa fa-info-circle btn btn-link m-0 p-0 pb-1 text-decoration-none text-warning"
                                    aria-hidden="true" data-toggle="popover" tabindex="0" data-bs-trigger="focus"
                                    title="Get Coordinates"
                                    data-bs-content="To get coordinates open <a href='http://maps.google.com/'>Google Maps</a> find a place and click on the map then copy and past highlited in red numbers from picture below. <img src='{{ asset('images/lat_instruction.png') }}' class='img-fluid' alt='instructions'>"></button>

                            </label>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('address_latitude') is-invalid @enderror"
                                        name="address_latitude" id="address_latitude" placeholder="Lat Coordinates"
                                        value="{{ old('address_latitude') }}">
                                    <label for="address_latitude" class="text-secondary">Latitude (51.547170, -2.582637)
                                        <span class="text-danger">*</span></label>
                                    @error('address_latitude')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <label>Additional information:</label>
                    <div class="col-md-12">
                        <div class="row">
                            {{-- Walk time --}}
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('walk_time') is-invalid @enderror" id="walk_time"
                                        name="walk_time" aria-label="Walk time">
                                        <option {{ old('walk_time') ? '' : 'selected' }} value="">----</option>
                                        <option {{ old('walk_time') == 1 ? 'selected' : '' }} value="1">1h</option>
                                        <option {{ old('walk_time') == 2 ? 'selected' : '' }} value="2">2h</option>
                                        <option {{ old('walk_time') == 3 ? 'selected' : '' }} value="3">3h</option>
                                        <option {{ old('walk_time') == 4 ? 'selected' : '' }} value="4">4h</option>
                                        <option {{ old('walk_time') == 5 ? 'selected' : '' }} value="5">5h</option>
                                        <option {{ old('walk_time') == 6 ? 'selected' : '' }} value="6">6h</option>
                                        <option {{ old('walk_time') == 7 ? 'selected' : '' }} value="7">7h</option>
                                        <option {{ old('walk_time') == 8 ? 'selected' : '' }} value="8">8h</option>
                                        <option {{ old('walk_time') == 9 ? 'selected' : '' }} value="9">9h</option>
                                    </select>
                                    <label for="walk_time">Walk time <span class="text-danger">*</span></label>
                                    @error('walk_time')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- Parking --}}
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('parking') is-invalid @enderror" id="parking"
                                        name="parking" aria-label="parking">
                                        <option {{ old('parking') ? '' : 'selected' }} value="">----</option>
                                        <option {{ old('parking') == 'true' ? 'selected' : '' }} value=true>Yes</option>
                                        <option {{ old('parking') == 'false' ? 'selected' : '' }} value=false>No</option>
                                    </select>
                                    <label for="parking">Parking <span class="text-danger">*</span></label>
                                    @error('parking')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- Parking details --}}
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="parking_details"
                                        placeholder="30 Diana Garder">
                                    <label class="text-secondary" for="parking_details"
                                        value="{{ old('parking_details') }}" required>Parking details</label>
                                </div>
                            </div>
                            {{-- Place type --}}
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select name="type_id" class="form-select @error('type_id') is-invalid @enderror"
                                        id="type_id" aria-label="Place type">
                                        <option {{ old('type_id') ? '' : 'selected' }} value="">----</option>
                                        <option {{ old('type_id') == 1 ? 'selected' : '' }} value=1>Field</option>
                                        <option {{ old('type_id') == 2 ? 'selected' : '' }} value=2>Beach</option>
                                        <option {{ old('type_id') == 3 ? 'selected' : '' }} value=3>Forest</option>
                                        <option {{ old('type_id') == 4 ? 'selected' : '' }} value=4>Mountains</option>
                                    </select>
                                    <label for="type_id">Place type <span class="text-danger">*</span></label>
                                    @error('type_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- Popularity --}}
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select name="popularity" class="form-select @error('popularity') is-invalid @enderror"
                                        id="popularity" aria-label="Popularity">
                                        <option {{ old('popularity') ? '' : 'selected' }} value="">----</option>
                                        <option {{ old('popularity') == 1 ? 'selected' : '' }} value="1">Low</option>
                                        <option {{ old('popularity') == 2 ? 'selected' : '' }} value="2">Medium</option>
                                        <option {{ old('popularity') == 3 ? 'selected' : '' }} value="3">High</option>
                                    </select>
                                    <label for="popularity">Place popularity <span class="text-danger">*</span></label>
                                    @error('popularity')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- description --}}
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description of this place" id="description"
                                name="description" style="height: 100px">{{ old('description') }}</textarea>
                            <label for="description">Description of this place <span class="text-danger">*</span></label>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{-- Publish checkbox --}}
                            @if (Auth::user()->can('publish places'))
                                <div class="form-check form-switch">
                                    <input class="form-check-input rounded-3" type="checkbox" id="publishedCheckbox"
                                        name="status" {{ Auth::user()->can('publish places') ? 'checked' : '' }}
                                        {{ Auth::user()->can('publish places') ? '' : 'disabled' }}>
                                    <label class="form-check-label unselectable" for="publishedCheckbox"
                                        title="Only Editors and Admins can publish places, if you are not editor your place will be pending review.">Publish
                                        when submitted</label>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-success text-white float-end">Submit</button>
                        </div>
                    </div>

                </form>
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
