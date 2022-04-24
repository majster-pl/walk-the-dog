@php
function checkIfSelected($value, $old, $selected)
{
    if (Request::is('add-new-place')) {
        return $old == $value ? 'selected' : '';
    } else {
        if (Str::length($old) > 0) {
            return $old == $value ? 'selected' : '';
        } else {
            return $value == $selected ? 'selected' : '';
        }
    }
}
@endphp

<form class="mt-1 row" action="{{ Request::is('add-new-place') ? route('add-new-place') : route('edit-place') }}"
    method="post" enctype="multipart/form-data">
    @if (!Request::is('add-new-place'))
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $place->id }}">
    @endif
    @csrf
    <div class="col col-12">
        {{-- Title --}}
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                placeholder="Title" title="Short title eg. 'Beautiful open plan field for dogs' "
                value="{{ Request::is('add-new-place') ? old('title') : old('title') ?? $place->title }}"
                autocomplete="off">
            <label class="text-secondary" for="title">Title <span class="text-danger">*</span></label>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>


    {{-- address --}}
    <div class="col-md-8">
        {{-- Address 1 --}}
        <label>Address:</label>
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('address_line1') is-invalid @enderror" name="address_line1"
                id="address_line1" placeholder="30 Diana Garder" title="Only enter if you know street name"
                value="{{ Request::is('add-new-place') ? old('address_line1') : old('address_line1') ?? $place->address_line1 }}">
            <label class="text-secondary" for="address_line1">Address 1</label>
            @error('address_line1')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        {{-- Address 2 --}}
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="address_line2" id="address_line2" placeholder="Downend"
                value="{{ Request::is('add-new-place') ? old('address_line2') : old('address_line2') ?? $place->address_line2 }}">
            <label class="text-secondary" for="address_line2">Address 2</label>
        </div>
        <div class="row">
            {{-- Town --}}
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('address_state_or_region') is-invalid @enderror"
                        name="address_state_or_region" id="address_state_or_region" placeholder="Town county"
                        title="Town name"
                        value="{{ Request::is('add-new-place')? old('address_state_or_region'): old('address_state_or_region') ?? $place->address_state_or_region }}">
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
                        name="address_city" id="address_city" placeholder="Town county" title="City name"
                        value="{{ Request::is('add-new-place') ? old('address_city') : old('address_city') ?? $place->address_city }}">
                    <label class="text-secondary" for="address_city">City <span class="text-danger">*</span></label>
                    @error('address_city')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            {{-- County --}}
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('address_country') is-invalid @enderror"
                        name="address_country" id="address_country" placeholder="Town county" title="Full country name"
                        value="{{ Request::is('add-new-place')? (old('address_country')? old('address_country'): 'United Kingdom'): old('address_country') ?? $place->address_country }}">
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
                    <input type="text" class="form-control  @error('address_postcode_or_zip') is-invalid @enderror"
                        name="address_postcode_or_zip" id="address_postcode_or_zip" placeholder="Town county"
                        title="Only enter post code if you know it"
                        value="{{ Request::is('add-new-place')? old('address_postcode_or_zip'): old('address_postcode_or_zip') ?? $place->address_postcode_or_zip }}">
                    <label class="text-secondary" for="address_postcode_or_zip">Post Code</label>
                    @error('address_postcode_or_zip')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            {{-- Coordinates --}}
            <label>Coordinates: <button type="button"
                    class="fa fa-info-circle btn btn-link m-0 p-0 pb-1 text-decoration-none text-warning"
                    aria-hidden="true" data-toggle="popover" tabindex="0" data-bs-trigger="focus"
                    title="Place coordinates"
                    data-bs-content="To get coordinates open <a href='http://maps.google.com/' target='_blank' rel='noreferrer'>Google Maps</a> find a place and click on the map then copy and past highlited numbers in red from picture below (bottom of the screen). <img src='{{ asset('images/lat_instruction.png') }}' class='img-fluid mt-2' alt='instructions'>"></button>

            </label>
            {{-- Coordinates --}}
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('address_latitude') is-invalid @enderror"
                        name="address_latitude" id="address_latitude" placeholder="Lat Coordinates"
                        title="Enter coordinates for the place"
                        value="{{ Request::is('add-new-place') ? old('address_latitude') : old('address_latitude') ?? $place->address_latitude }}">
                    <label for="address_latitude" class="text-secondary">Latitude (51.547170, -2.582637)
                        <span class="text-danger">*</span></label>
                    @error('address_latitude')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Image --}}
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 mb-3">
                <label>Main image:</label>
                <div class="card position-relative @error('main_image_path') border-danger border-1 @enderror" style="">
                    <div class="w-100 position-absolute">
                        <button id="clearButton" type="button" class="btn-close float-end m-2 bg-danger d-none"
                            aria-label="Close"></button>
                    </div>
                    <img id="main_image_src"
                        src="{{ isset($place->main_image_path)? asset('/uploads/images/' . $place->main_image_path): asset('images/image-missing.webp') }}"
                        class="card-img-top" alt="Main image">
                    <div class="card-body">
                        <div class="input-group">
                            <input id="main_image_input" type="file" name="main_image_path" class="form-control"
                                onchange="document.getElementById('main_image_src').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        @error('main_image_path')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>
            {{-- <div class="col-md-12 mb-3">
                <label>Additional images:</label>
                <div class="input-group">
                    <input type="file" class="form-control" disabled>
                    
                </div>
                <small class="text-secondary">You can select up to 5 pictures (press and hold Ctrl to select)</small>
            </div> --}}
        </div>
    </div>

    <label>Additional information:</label>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        {{-- Walk time --}}
                        <div class="form-floating mb-3" title="Awrage walk time">
                            <select class="form-select @error('walk_time') is-invalid @enderror" id="walk_time"
                                name="walk_time" aria-label="Walk time">
                                <option {{ checkIfSelected(0, old('walk_time'), $place->walk_time ?? null) }}
                                    value="" disabled>----
                                </option>
                                <option {{ checkIfSelected(1, old('walk_time'), $place->walk_time ?? null) }}
                                    value="1">1h
                                </option>
                                <option {{ checkIfSelected(2, old('walk_time'), $place->walk_time ?? null) }}
                                    value="2">2h
                                </option>
                                <option {{ checkIfSelected(3, old('walk_time'), $place->walk_time ?? null) }}
                                    value="3">3h
                                </option>
                                <option {{ checkIfSelected(4, old('walk_time'), $place->walk_time ?? null) }}
                                    value="4">4h
                                </option>
                                <option {{ checkIfSelected(5, old('walk_time'), $place->walk_time ?? null) }}
                                    value="5">5h
                                </option>
                                <option {{ checkIfSelected(6, old('walk_time'), $place->walk_time ?? null) }}
                                    value="6">6h
                                </option>
                                <option {{ checkIfSelected(7, old('walk_time'), $place->walk_time ?? null) }}
                                    value="7">7h
                                </option>
                                <option {{ checkIfSelected(8, old('walk_time'), $place->walk_time ?? null) }}
                                    value="8">8h
                                </option>
                                <option {{ checkIfSelected(9, old('walk_time'), $place->walk_time ?? null) }}
                                    value="9">9h
                                </option>
                            </select>
                            <label for="walk_time">Walk time <span class="text-danger">*</span></label>
                            @error('walk_time')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- Parking --}}
                    <div class="col-md-6">
                        <div class="form-floating mb-3" title="Is parking available?">
                            <select class="form-select @error('parking') is-invalid @enderror" id="parking"
                                name="parking" aria-label="parking">
                                <option {{ checkIfSelected(null, old('parking'), $place->parking ?? null) }} value=''
                                    disabled>----
                                </option>
                                <option {{ checkIfSelected('1', old('parking'), $place->parking ?? null) }} value=1>
                                    Yes
                                </option>
                                <option {{ checkIfSelected('0', old('parking'), $place->parking ?? null) }} value=0>
                                    No
                                </option>
                            </select>
                            <label for="parking">Parking <span class="text-danger">*</span></label>
                            @error('parking')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- Place type --}}
                    <div class="col-md-6">
                        <div class="form-floating mb-3" title="What kind of place is it?">
                            <select name="type_id" class="form-select @error('type_id') is-invalid @enderror"
                                id="type_id" aria-label="Place type">
                                <option disabled {{ checkIfSelected(null, old('type_id'), $place->type_id ?? null) }}
                                    value="">----
                                </option>
                                {{ $placeTypes->count() }}
                                @foreach ($placeTypes as $type)
                                    <option {{ checkIfSelected($type->id, old('type_id'), $place->type_id ?? null) }}
                                        value={{ $type->id }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <label for="type_id">Place type <span class="text-danger">*</span></label>
                            @error('type_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- activity --}}
                    <div class="col-md-6">
                        <div class="form-floating mb-3"
                            title="How busy is this place in tearms of number of other pets?">
                            <select name="activity" class="form-select @error('activity') is-invalid @enderror"
                                id="activity" aria-label="activity">
                                <option {{ checkIfSelected(0, old('activity'), $place->activity ?? null) }} value=""
                                    disabled>
                                    ----
                                </option>
                                <option {{ checkIfSelected(1, old('activity'), $place->activity ?? null) }} value=1>
                                    Low
                                </option>
                                <option {{ checkIfSelected(2, old('activity'), $place->activity ?? null) }} value=2>
                                    Medium
                                </option>
                                <option {{ checkIfSelected(3, old('activity'), $place->activity ?? null) }} value=3>
                                    High
                                </option>
                            </select>
                            <label for="activity">Place activity <span class="text-danger">*</span></label>
                            @error('activity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="row h-100">
                    <div class="col-12">
                        {{-- Parking details --}}
                        <div class="form-floating pb-3 h-100" title="Enter additional information about parking">
                            <textarea class="form-control h-100" name="parking_details" id="parking_details"
                                placeholder="Free parking for 2h">{{ Request::is('add-new-place') ? old('parking_details') : old('parking_details') ?? $place->parking_details }}</textarea>
                            <label class="text-secondary" for="parking_details"
                                value="{{ Request::is('add-new-place') ? old('parking_details') : old('parking_details') ?? $place->parking_details }}"
                                required>Parking details</label>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        {{-- Only for dogs --}}
                        <div class="col-md-6">
                            <div class="form-floating mb-3" title="Is this place only available for dogs?">
                                <select class="form-select @error('dogs_only') is-invalid @enderror" id="dogs_only"
                                    name="dogs_only" aria-label="dogs_only">
                                    <option {{ checkIfSelected(null, old('dogs_only'), $place->dogs_only ?? null) }}
                                        value='' disabled>
                                        ----
                                    </option>
                                    <option {{ checkIfSelected('1', old('dogs_only'), $place->dogs_only ?? null) }}
                                        value=1>
                                        Yes
                                    </option>
                                    <option {{ checkIfSelected('0', old('dogs_only'), $place->dogs_only ?? null) }}
                                        value=0>
                                        No
                                    </option>
                                </select>
                                <label for="dogs_only">Dogs only <span class="text-danger">*</span></label>
                                @error('dogs_only')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- Seasonal access --}}
                        <div class="col-md-6">
                            <div class="form-floating mb-3" title="Are there any restrictions in summer/winter time?">
                                <select class="form-select @error('seasonal_access') is-invalid @enderror"
                                    id="seasonal_access" name="seasonal_access" aria-label="seasonal_access">
                                    <option
                                        {{ checkIfSelected(null, old('seasonal_access'), $place->seasonal_access ?? null) }}
                                        value='' disabled>
                                        ----
                                    </option>
                                    <option
                                        {{ checkIfSelected('1', old('seasonal_access'), $place->seasonal_access ?? null) }}
                                        value=1>Yes
                                    </option>
                                    <option
                                        {{ checkIfSelected('0', old('seasonal_access'), $place->seasonal_access ?? null) }}
                                        value=0>No
                                    </option>
                                </select>
                                <label for="seasonal_access">Seasonal access <span
                                        class="text-danger">*</span></label>
                                @error('seasonal_access')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- Dogs off lead --}}
                        <div class="col-md-6">
                            <div class="form-floating mb-3" title="Select yes if this place is only for dogs">
                                <select class="form-select @error('off_lead') is-invalid @enderror" id="off_lead"
                                    name="off_lead" aria-label="off_lead">
                                    <option {{ checkIfSelected(null, old('off_lead'), $place->off_lead ?? null) }}
                                        value='' disabled>
                                        ----
                                    </option>
                                    <option {{ checkIfSelected('1', old('off_lead'), $place->off_lead ?? null) }}
                                        value=1>
                                        Yes
                                    </option>
                                    <option {{ checkIfSelected('0', old('off_lead'), $place->off_lead ?? null) }}
                                        value=0>
                                        No
                                    </option>
                                </select>
                                <label for="off_lead">Dogs allowed off lead <span
                                        class="text-danger">*</span></label>
                                @error('off_lead')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- Access to cafe --}}
                        <div class="col-md-6">
                            <div class="form-floating mb-3" title="Is there any cafe nearby this place?">
                                <select class="form-select @error('cafe_access') is-invalid @enderror"
                                    id="cafe_access" name="cafe_access" aria-label="cafe_access">
                                    <option
                                        {{ checkIfSelected(null, old('cafe_access'), $place->cafe_access ?? null) }}
                                        value='' disabled>
                                        ----
                                    </option>
                                    <option
                                        {{ checkIfSelected('1', old('cafe_access'), $place->cafe_access ?? null) }}
                                        value=1>Yes
                                    </option>
                                    <option
                                        {{ checkIfSelected('0', old('cafe_access'), $place->cafe_access ?? null) }}
                                        value=0>No
                                    </option>
                                </select>
                                <label for="cafe_access">Cafe access <span class="text-danger">*</span></label>
                                @error('cafe_access')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Seasonal access details --}}
                <div class="col-md-6">
                    <div class="form-floating pb-3 h-100"
                        title="Additional information about seasonal access eg. Dogs not allowed in summer between Jun and October'">
                        <textarea class="form-control h-100" id="seasonal_details" name="seasonal_details"
                            placeholder="Dogs not allowed in summer">{{ Request::is('add-new-place') ? old('seasonal_details') : old('seasonal_details') ?? $place->seasonal_details }}</textarea>
                        <label class="text-secondary" for="seasonal_details"
                            value="{{ Request::is('add-new-place') ? old('seasonal_details') : old('seasonal_details') ?? $place->parking_details }}"
                            required>Seasonal access details</label>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-12">
            <div class="row">

                {{-- Access to water --}}
                <div class="col-md-3">
                    <div class="form-floating mb-3" title="Is there access to stream, pond or sea?">
                        <select class="form-select @error('access_to_water') is-invalid @enderror"
                            id="access_to_water" name="access_to_water" aria-label="access_to_water">
                            <option
                                {{ checkIfSelected(null, old('access_to_water'), $place->access_to_water ?? null) }}
                                value='' disabled>
                                ----
                            </option>
                            <option
                                {{ checkIfSelected('1', old('access_to_water'), $place->access_to_water ?? null) }}
                                value=1>Yes
                            </option>
                            <option
                                {{ checkIfSelected('0', old('access_to_water'), $place->access_to_water ?? null) }}
                                value=0>No
                            </option>
                        </select>
                        <label for="access_to_water">Access to water <span class="text-danger">*</span></label>
                        @error('access_to_water')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                {{-- Trash / disposal bins --}}
                <div class="col-md-3">
                    <div class="form-floating mb-3" title="Are there poo bins nearby?">
                        <select class="form-select @error('disposal_bins') is-invalid @enderror" id="disposal_bins"
                            name="disposal_bins" aria-label="disposal_bins">
                            <option {{ checkIfSelected(null, old('disposal_bins'), $place->disposal_bins ?? null) }}
                                value='' disabled>
                                ----
                            </option>
                            <option {{ checkIfSelected('1', old('disposal_bins'), $place->disposal_bins ?? null) }}
                                value=1>Yes
                            </option>
                            <option {{ checkIfSelected('0', old('disposal_bins'), $place->disposal_bins ?? null) }}
                                value=0>No
                            </option>
                        </select>
                        <label for="disposal_bins">Poo bins <span class="text-danger">*</span></label>
                        @error('disposal_bins')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

    </div>
    <label>Short description:</label>
    <div class="col-12-">
        <div class="row">
            {{-- description --}}
            <div class="col-md-12">

                <div class="form-floating mb-3" title="Enter more about this page what might be usefull for others">
                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description of this place"
                        id="description" name="description"
                        style="height: 10rem">{{ Request::is('add-new-place') ? old('description') : old('description') ?? $place->description }}</textarea>
                    <label class="text-secondary" for="description">Description of this place <span
                            class="text-danger">*</span></label>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col col-12">
                {{-- Additional Pictures --}}
                <label>Additional Pictures:</label>
                <div class="form-floating mb-3">
                    @livewire('place-pictures-wire', ['pictures' => isset($place->pictures) ? $place->pictures : [], 'place_id' =>
                    isset($place->id) ? $place->id: '0'])
                </div>
            </div>
            <div>
                {{-- Publish checkbox --}}
                @if (Auth::user()->can('publish places'))
                    <div class="form-check form-switch {{ Request::segment(3) == 'review' ? 'd-none' : ' ' }}">
                        <input class="form-check-input rounded-3" type="checkbox" id="publishedCheckbox" name="status"
                            {{ Auth::user()->can('publish places') ? 'checked' : '' }}
                            {{ Auth::user()->can('publish places') ? '' : 'disabled' }}>
                        <label class="form-check-label unselectable" for="publishedCheckbox"
                            title="Only Editors and Admins can publish places, if you are not editor your place will be pending review.">Publish
                            when submitted</label>
                    </div>
                @endif
                {{-- @php
                    dd(Request::segment(3));
                @endphp --}}
                <button type="submit" class="btn btn-success text-white fw-bold float-end">
                    @switch(Request::segment(3))
                        @case('edit')
                            Save
                        @break

                        @case('review')
                            Publish
                        @break

                        @default
                            Submit
                    @endswitch
                </button>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $("[data-toggle='popover']").popover({
                    html: true
                });
            });

            $('#clearButton').click(function() {
                document.getElementById('main_image_src').src = "/images/image-missing.webp";
                document.getElementById('main_image_input').value = "";
                var element = document.getElementById("clearButton");
                element.classList.add("d-none");
            });

            $('#main_image_input').change(function() {
                console.log('Setting image...');
                var element = document.getElementById("clearButton");
                element.classList.remove("d-none");
            });

        });
    </script>
</form>
