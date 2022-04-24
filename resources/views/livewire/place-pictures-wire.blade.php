<div class="border-bottom pb-4">
    <div class="row row-cols-1 row-cols-md-3 g-3">
        @foreach ($pictures as $indexKey => $picture)
            <div class="col">
                <div class="card h-100">
                    <img class="h-100" style="object-fit: cover; height: 22rem !important"
                        src="{{ asset('storage/uploads/images/' . $picture->name) }}" alt="{{ $picture->name }}" title="{{ $picture->name }}">
                    <button type="button" wire:click="removeImage({{ $indexKey }}, {{ $picture->id }})"
                        class="btn-close position-absolute end-0 mt-2 me-2" aria-label="Close" title="Remove"></button>
                </div>
            </div>
        @endforeach
        <input id="upload-btn" name="name" type="file" wire:model.lazy="images" multiple hidden>
        <input type="text" name="place_id" value="{{ $place_id }}" hidden>
        <div class="col">
            <label for="upload-btn">

                <div class="card h-100" style="cursor: pointer">
                    <a class="position-relevent">
                        <h4 class="position-absolute ms-3 mt-3 text-decoration-none text-black  @error('images.*') d-none @enderror">Add New
                        </h4>
                            @error('images.*') <h5 class="position-absolute ms-4 mt-4 text-decoration-none text-danger">{{$message }} <br>Please try again...</h5>
                            @enderror
                        <img class="card-img-top img-fluid " style="object-fit: cover; height: 22rem" src="{{ asset('images/add-new2.png') }}"
                            alt="Add new picture">
                        <small class="position-absolute bottom-0 start-0 text-decoration-none text-secondary ms-2 mb-1">You can add multiple pictures (hold Ctrl)</small>

                    </a>
                </div>
            </label>
        </div>
    </div>
</div>
