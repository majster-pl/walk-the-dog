<div>
    <form class="mt-1 row" wire:submit.prevent="submit" enctype="multipart/form-data">
        @csrf
        <div class="col col-12">
            {{-- Title --}}
            <div class="form-floating mb-3">
                <input type="text" wire:model.debounce.500ms="title"
                    class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title"
                    title="Short title eg. 'Beautiful open plan field for dogs' " value="{{ $title }}"
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
                <input type="text" wire:model.debounce.500ms="address_line1"
                    class="form-control @error('address_line1') is-invalid @enderror" name="address_line1"
                    id="address_line1" placeholder="30 Diana Garder" title="Only enter if you know street name"
                    value="{{ $address_line1 }}">
                <label class="text-secondary" for="address_line1">Address 1</label>
                @error('address_line1')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- Address 2 --}}
            <div class="form-floating mb-3">
                <input type="text" wire:model.debounce.500ms="address_line2" class="form-control" name="address_line2"
                    id="address_line2" placeholder="Downend" value="{{ $address_line2 }}">
                <label class="text-secondary" for="address_line2">Address 2</label>
            </div>
            <div class="row">
                {{-- Town --}}
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" wire:model.debounce.500ms="address_state_or_region"
                            class="form-control @error('address_state_or_region') is-invalid @enderror"
                            name="address_state_or_region" id="address_state_or_region" placeholder="Town county"
                            title="Town name" value="{{ $address_state_or_region }}">
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
                        <input type="text" wire:model.debounce.500ms="address_city"
                            class="form-control @error('address_city') is-invalid @enderror" name="address_city"
                            id="address_city" placeholder="Town county" title="City name" value="{{ $address_city }}">
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
                        <input type="text" wire:model.debounce.500ms="address_country"
                            class="form-control @error('address_country') is-invalid @enderror" name="address_country"
                            id="address_country" placeholder="Town county" title="Full country name"
                            value="{{ $address_country }}">
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
                        <input type="text" wire:model.debounce.500ms="address_postcode_or_zip"
                            class="form-control  @error('address_postcode_or_zip') is-invalid @enderror"
                            name="address_postcode_or_zip" id="address_postcode_or_zip" placeholder="Town county"
                            title="Only enter post code if you know it" value="{{ $address_postcode_or_zip }}">
                        <label class="text-secondary" for="address_postcode_or_zip">Post Code</label>
                        @error('address_postcode_or_zip')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                {{-- Coordinates label --}}
                <label>Coordinates: <button type="button"
                        class="fa fa-info-circle btn btn-link m-0 p-0 pb-1 text-decoration-none text-warning"
                        aria-hidden="true" data-toggle="popover" tabindex="0" data-bs-trigger="focus"
                        title="Place coordinates"
                        data-bs-content="To get coordinates open <a href='http://maps.google.com/' target='_blank' rel='noreferrer'>Google Maps</a> find a place and click on the map then copy and past highlited numbers in red from picture below (bottom of the screen). <img src='{{ asset('images/lat_instruction.png') }}' class='img-fluid mt-2' alt='instructions'>"></button>

                </label>
                {{-- Coordinates --}}
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" wire:model.debounce.500ms="address_latitude"
                            class="form-control @error('address_latitude') is-invalid @enderror" name="address_latitude"
                            id="address_latitude" placeholder="Lat Coordinates" title="Enter coordinates for the place"
                            value="{{ $address_latitude }}">
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
                    <div class="card position-relative @error('main_image_path') border-danger border-1 @enderror"
                        style="">
                        <div class="w-100 position-absolute">
                        </div>
                        <input id="main-image-upload-btn" {{ !isset($main_image_path) ? '' : 'disabled' }}
                            wire:model.lazy="main_image_path" type="file" name="main_image_path" class="form-control"
                            hidden>

                        <label for="main-image-upload-btn">
                            <div class="card h-100 " style="cursor: pointer">
                                <a class="">
                                    @if (!isset($main_image_path))
                                        <h4 class="position-absolute ms-3 mt-3 text-decoration-none text-black">
                                            Add Picture
                                        </h4>
                                    @endif
                                    @if (isset($main_image_path))
                                        <button id="clearButton" wire:click="deleteMainImagePath" type="button"
                                            style="font-size: 1.6rem" class="btn-close position-absolute end-0 m-2"
                                            aria-label="Close"></button>
                                    @endif
                                    <img id="main_image_src"
                                        src="{{ isset($main_image_path) ? asset('place-images/' . $main_image_path) : asset('images/add-new2.png') }}"
                                        class="card-img-top img-fluid" alt="Main image">

                                </a>
                                <button wire:loading wire:target="main_image_path" class="btn btn-primary"
                                    style="z-index: 10" type="button">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Uploading...
                                </button>
                            </div>
                        </label>

                    </div>
                    @error('main_image_path')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>
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
                                <select class="form-select @error('walk_time') is-invalid @enderror"
                                    wire:model="walk_time" id="walk_time" name="walk_time" aria-label="Walk time">
                                    @foreach ($walk_options as $option)
                                        <option value="{{ $option }}">
                                            {{ $option == null ? '----' : $option . 'h' }}</option>
                                    @endforeach
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
                                    wire:model="parking" name="parking" aria-label="parking">
                                    @foreach ($yes_or_no as $option)
                                        <option value="{{ $option['value'] }}">
                                            {{ Str::ucfirst($option['name']) }}</option>
                                    @endforeach
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
                                <select name="place_type" class="form-select @error('place_type') is-invalid @enderror"
                                    wire:model="place_type" id="place_type" aria-label="Place type">
                                    <option value="">----</option>
                                    @foreach ($place_type_options as $option)
                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach

                                </select>
                                <label for="place_type">Place type <span class="text-danger">*</span></label>
                                @error('place_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- activity --}}
                        <div class="col-md-6">
                            <div class="form-floating mb-3"
                                title="How busy is this place in tearms of number of other pets?">
                                <select name="activity" class="form-select @error('activity') is-invalid @enderror"
                                    wire:model="activity" id="activity" aria-label="activity">
                                    @foreach ($activity_options as $option)
                                        <option value="{{ $option['value'] }}">
                                            {{ Str::ucfirst($option['name']) }}</option>
                                    @endforeach
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
                                <textarea class="form-control h-100" name="parking_details" id="parking_details" placeholder="Free parking for 2h"
                                    wire:model="parking_details">{{ $parking_details }}</textarea>
                                <label class="text-secondary" for="parking_details"
                                    value="{{ $parking_details }}">Parking
                                    details</label>
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
                                        wire:model="dogs_only" name="dogs_only" aria-label="dogs_only">
                                        @foreach ($yes_or_no as $option)
                                            <option value="{{ $option['value'] }}">
                                                {{ Str::ucfirst($option['name']) }}</option>
                                        @endforeach
                                    </select>
                                    <label for="dogs_only">Dogs only <span class="text-danger">*</span></label>
                                    @error('dogs_only')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            {{-- Seasonal access --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3"
                                    title="Are there any restrictions in summer/winter time?">
                                    <select class="form-select @error('seasonal_access') is-invalid @enderror"
                                        wire:model="seasonal_access" id="seasonal_access" name="seasonal_access"
                                        aria-label="seasonal_access">
                                        @foreach ($yes_or_no as $option)
                                            <option value="{{ $option['value'] }}">
                                                {{ Str::ucfirst($option['name']) }}</option>
                                        @endforeach
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
                                        wire:model="off_lead" name="off_lead" aria-label="off_lead">
                                        @foreach ($yes_or_no as $option)
                                            <option value="{{ $option['value'] }}">
                                                {{ Str::ucfirst($option['name']) }}</option>
                                        @endforeach
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
                                        wire:model="cafe_access" id="cafe_access" name="cafe_access"
                                        aria-label="cafe_access">
                                        @foreach ($yes_or_no as $option)
                                            <option value="{{ $option['value'] }}">
                                                {{ Str::ucfirst($option['name']) }}</option>
                                        @endforeach
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
                            <textarea class="form-control h-100" id="seasonal_details" wire:model.lazy="seasonal_details" name="seasonal_details"
                                placeholder="Dogs not allowed in summer">{{ $seasonal_details }}</textarea>
                            <label class="text-secondary" for="seasonal_details">Seasonal access details</label>
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
                                wire:model="access_to_water" id="access_to_water" name="access_to_water"
                                aria-label="access_to_water">
                                @foreach ($yes_or_no as $option)
                                    <option value="{{ $option['value'] }}">
                                        {{ Str::ucfirst($option['name']) }}</option>
                                @endforeach
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
                            <select class="form-select @error('disposal_bins') is-invalid @enderror"
                                wire:model="disposal_bins" id="disposal_bins" name="disposal_bins"
                                aria-label="disposal_bins">
                                @foreach ($yes_or_no as $option)
                                    <option value="{{ $option['value'] }}">
                                        {{ Str::ucfirst($option['name']) }}</option>
                                @endforeach
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

                    <div class="form-floating mb-3"
                        title="Enter more about this page what might be usefull for others">
                        <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description of this place"
                            wire:model.lazy="description" id="description" name="description"
                            style="height: 10rem">{{ $description }}</textarea>
                        <label class="text-secondary" for="description">Description of this place <span
                                class="text-danger">*</span></label>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col col-12">
                    {{-- Additional Pictures --}}
                    <label>Additional Pictures: <small>(max 6)</small></label>
                    <div class="form-floating mb-3">
                        @livewire('place-pictures-wire', ['pictures' => $place->pictures, 'place_id' => $place->id])
                    </div>
                </div>
                <div>
                    {{-- Publish checkbox --}}
                    @if (Auth::user()->can('publish places'))
                        <div class="form-check form-switch ">
                            <input class="form-check-input rounded-3" type="checkbox" id="publishedCheckbox"
                                name="status" wire:model="publishToggle"
                                {{ Auth::user()->can('publish places') ? '' : 'disabled' }}>
                            <label class="form-check-label unselectable" for="publishedCheckbox"
                                title="Only Editors and Admins can publish places, if you are not editor your place will be pending review.">Publish
                                when submitted</label>
                        </div>
                    @endif
                    {{-- Submit button --}}
                    <button type="submit" class="btn btn-success text-white fw-bold float-end">
                        @if ($publishToggle)
                            Publish
                        @else
                            @switch($page)
                                @case('add')
                                    Submit
                                @break

                                @case('edit')
                                    Save changes
                                @break

                                @case('review')
                                    Save for later
                                @break

                                @default
                                    Save
                            @endswitch
                        @endif
                    </button>
                    {{-- cancel button --}}
                    <a  href="{{ URL::previous() }}" class="btn btn-danger float-end text-white fw-bold me-3">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
