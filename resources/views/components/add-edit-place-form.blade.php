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

<form class="my-3 row" action="{{ Request::is('add-new-place') ? route('add-new-place') : route('edit-place') }}"
    method="post">
    @if (!Request::is('add-new-place'))`
        @method('PATCH')
        <input type="hidden" name="id" value="{{ $place->id }}">
    @endif
    @csrf
    <div class="col col-12">

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                placeholder="Title"
                value="{{ Request::is('add-new-place') ? old('title') : old('title') ?? $place->title }}"
                autocomplete="off">
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
            <input type="text" class="form-control @error('address_line1') is-invalid @enderror" name="address_line1"
                id="address_line1" placeholder="30 Diana Garder"
                value="{{ Request::is('add-new-place') ? old('address_line1') : old('address_line1') ?? $place->address_line1 }}">
            <label class="text-secondary" for="address_line1" required>Address 1 <span
                    class="text-danger">*</span></label>
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
                        name="address_city" id="address_city" placeholder="Town county"
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
                        name="address_country" id="address_country" placeholder="Town county"
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
                    title="Get Coordinates"
                    data-bs-content="To get coordinates open <a href='http://maps.google.com/' target='_blank' rel='noreferrer'>Google Maps</a> find a place and click on the map then copy and past highlited in red numbers from picture below. <img src='{{ asset('images/lat_instruction.png') }}' class='img-fluid mt-2' alt='instructions'>"></button>

            </label>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('address_latitude') is-invalid @enderror"
                        name="address_latitude" id="address_latitude" placeholder="Lat Coordinates"
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
    <label>Additional information:</label>
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        {{-- Walk time --}}
                        <div class="form-floating mb-3">
                            <select class="form-select @error('walk_time') is-invalid @enderror" id="walk_time"
                                name="walk_time" aria-label="Walk time">
                                <option {{ checkIfSelected(0, old('walk_time'), $place->walk_time ?? null) }}
                                    value="">----
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
                        <div class="form-floating mb-3">
                            <select class="form-select @error('parking') is-invalid @enderror" id="parking"
                                name="parking" aria-label="parking">
                                <option {{ checkIfSelected(null, old('parking'), $place->parking ?? null) }}
                                    value=''>----
                                </option>
                                <option {{ checkIfSelected('1', old('parking'), $place->parking ?? null) }} value=1>Yes
                                </option>
                                <option {{ checkIfSelected('0', old('parking'), $place->parking ?? null) }} value=0>No
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
                        <div class="form-floating mb-3">
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
                    {{-- Popularity --}}
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select name="popularity" class="form-select @error('popularity') is-invalid @enderror"
                                id="popularity" aria-label="Popularity">
                                <option {{ checkIfSelected(0, old('popularity'), $place->popularity ?? null) }}
                                    value="">----
                                </option>
                                <option {{ checkIfSelected(1, old('popularity'), $place->popularity ?? null) }}
                                    value=1>Low
                                </option>
                                <option {{ checkIfSelected(2, old('popularity'), $place->popularity ?? null) }}
                                    value=2>
                                    Medium
                                </option>
                                <option {{ checkIfSelected(3, old('popularity'), $place->popularity ?? null) }}
                                    value=3>High
                                </option>
                            </select>
                            <label for="popularity">Place popularity <span class="text-danger">*</span></label>
                            @error('popularity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            {{-- Parking details --}}
            <div class="col-md-4">
                <div class="row h-100">
                    <div class="col-12">
                        <div class="form-floating pb-3 h-100">
                            <textarea class="form-control h-100" id="parking_details" placeholder="30 Diana Garder"> </textarea>
                            <label class="text-secondary" for="parking_details"
                                value="{{ Request::is('add-new-place') ? old('parking_details') : old('parking_details') ?? $place->parking_details }}"
                                required>Parking details</label>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        {{-- description --}}
        <div class="form-floating mb-3">
            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description of this place"
                id="description" name="description"
                style="height: 100px">{{ Request::is('add-new-place') ? old('description') : old('description') ?? $place->description }}</textarea>
            <label class="text-secondary" for="description">Description of this place <span
                    class="text-danger">*</span></label>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            {{-- Publish checkbox --}}
            @if (Auth::user()->can('publish places'))
                <div class="form-check form-switch">
                    <input class="form-check-input rounded-3" type="checkbox" id="publishedCheckbox" name="status"
                        {{ Auth::user()->can('publish places') ? 'checked' : '' }}
                        {{ Auth::user()->can('publish places') ? '' : 'disabled' }}>
                    <label class="form-check-label unselectable" for="publishedCheckbox"
                        title="Only Editors and Admins can publish places, if you are not editor your place will be pending review.">Publish
                        when submitted</label>
                </div>
            @endif
            <button type="submit" class="btn btn-success text-white float-end">Submit</button>
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
</form>
