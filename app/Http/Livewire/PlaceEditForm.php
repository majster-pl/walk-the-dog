<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Place;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingReviewToUserMail;
use Illuminate\Auth\Events\Validated;
use App\Mail\PlacePublishedToUserMail;
use Illuminate\Support\Facades\Storage;
use App\Mail\PendingReviewToEditorsMail;
use App\Mail\PendingEditReviewToUserMail;
use Illuminate\Support\Facades\Validator;
use App\Mail\PendingEditReviewToEditorsMail;

class PlaceEditForm extends Component
{
    use WithFileUploads;

    public $place;
    public $placeTypes;
    public $page;


    protected $rules = [
        'title' => 'required|min:2',
        'address_state_or_region' => 'required|min:3',
        'address_city' => 'required|min:3',
        'address_country' => 'required|min:3',
        'address_latitude' => 'required|min:15',
        'walk_time' => 'required',
        'parking' => 'required',
        'place_type' => 'required',
        'activity' => 'required',
        'dogs_only' => 'required',
        'seasonal_access' => 'required',
        'off_lead' => 'required',
        'cafe_access' => 'required',
        'access_to_water' => 'required',
        'disposal_bins' => 'required',
        'description' => 'required|min:10'
    ];

    protected $messages = [
        'main_image_path.mimes' => 'Selected file extension is not supported.',
    ];


    public function render()
    {
        return view('livewire.place-edit-form');
    }

    public function mount($place, $placeTypes, $page)
    {
        $this->yes_or_no =
            array(
                0 => array('value' => null, 'name' => '----'),
                1 => array('value' => 1, 'name' => 'yes'),
                2 => array('value' => 0, 'name' => 'no'),
            );

        $this->place = $place;
        $this->page = $page;

        $this->title = $place->title;
        $this->address_line1 = $place->address_line1;
        $this->address_line2 = $place->address_line2;
        $this->address_state_or_region = $place->address_state_or_region;
        $this->address_city = $place->address_city;
        $this->address_country = $place->address_country;
        $this->address_postcode_or_zip = $place->address_postcode_or_zip;
        $this->address_latitude = $place->address_latitude;
        $this->main_image_path = $place->main_image_path;
        $this->walk_time = $place->walk_time;
        $this->walk_options = [null, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $this->parking = $place->parking;
        $this->place_type = $place->type_id;
        $this->place_type_options = $placeTypes;

        // possibly in the future to be pulled from DB...
        $this->activity = $place->activity;
        $this->activity_options = array(
            0 => array('value' => null, 'name' => '----'),
            1 => array('value' => 1, 'name' => 'Low'),
            2 => array('value' => 2, 'name' => 'Medium'),
            3 => array('value' => 3, 'name' => 'High'),
        );
        $this->parking_details = $place->parking_details;
        $this->dogs_only = $place->dogs_only;
        $this->seasonal_access = $place->seasonal_access;
        $this->off_lead = $place->off_lead;
        $this->cafe_access = $place->cafe_access;
        $this->seasonal_details = $place->seasonal_details;
        $this->access_to_water = $place->access_to_water;
        $this->disposal_bins = $place->disposal_bins;
        $this->description = $place->description;

        $this->publishToggle = null;
    }


    public function updated($propertyName, $value)
    {
        $this->validateOnly($propertyName, $this->rules);
        // if validated updated validated field in table
        // $place = Place::find($this->place->id);
        // $place->update([
        //     $propertyName => $value,
        // ]);
    }

    public function updatePlace($newStatus = 'draft')
    {
        $place = Place::find($this->place->id);
        # code...
        $this->validate();

        return $place->update([
            'title' => $this->title,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'address_state_or_region' => $this->address_state_or_region,
            'address_city' => $this->address_city,
            'address_country' => $this->address_country,
            'address_postcode_or_zip' => $this->address_postcode_or_zip,
            'address_latitude' => $this->address_latitude,
            'main_image_path' => $this->main_image_path,
            'walk_time' => $this->walk_time,
            'parking' => $this->parking,
            'type_id' => $this->place_type,
            'activity' => $this->activity,
            'parking_details' => $this->parking_details,
            'dogs_only' => $this->dogs_only,
            'seasonal_access' => $this->seasonal_access,
            'off_lead' => $this->off_lead,
            'cafe_access' => $this->cafe_access,
            'seasonal_details' => $this->seasonal_details,
            'access_to_water' => $this->access_to_water,
            'disposal_bins' => $this->disposal_bins,
            'description' => $this->description,
            'status' => $newStatus,
        ]);
    }

    public function submit()
    {
        //if main picture not selected add to validation (work around).
        $this->rules['main_image_path'] = !$this->main_image_path ? 'required|mimes:png,jpg,jpeg,webp|max:5048' : 'nullable';
        $validator = Validator::make($this->all(), $this->rules);
 
            // $validator = $this->validate();
        if ($validator->fails()) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'message' => 'Form Error!',
                'text' => 'Please check the form and try again!',
                'confirmButtonColor' => '#38c172',
            ]);
        }
        $user = User::find(Auth::id());


        // if editor or admin, allow to publish otherwise change status to pending.
        // $user = User::find(Auth::id());
        $this->canPublish = $user->can('publish places');

        // if user is editor, publish place 
        if ($user->can('publish places')) {
            $update = $this->updatePlace('published');
            if (!$update) {
                return redirect()->back()->with('error', 'There was problem updating place... Please try again later!');
            }
            // if place was pending review, send email to creator
            if ($this->place->status == 'pending') {
                Mail::to($this->place->user->email)->send(new PlacePublishedToUserMail($this->place, $this->place->user));
                return redirect('place/' . $this->place->slug)->with('success', 'Place published successfully!');
            }
            return redirect('place/' . $this->place->slug)->with('success', 'Place updated successfully!');
        }

        // if Auth user is also creator of the place change status to "pending" and send 
        // confirmation email to user and emails to the editors to review this place.
        if ($this->place->user->id === Auth::id()) {
            $update = $this->updatePlace('pending');
            if (!$update) {

                return redirect()->back()->with('error', 'There was problem updating place... Please try again later!');
            } else {
                $writers = User::role('editor')->get('email');

                if ($this->place->status == 'draft') {
                    // dd('new place...');
                    Mail::bcc($writers)->send(new PendingReviewToEditorsMail($this->place, $user));
                    Mail::to($this->place->user->email)->send(new PendingReviewToUserMail($this->place, $this->place->user));
                    return redirect('new-place-confirmation')->with(['warning' => 'Your place is currently awaiting moderator review...', 'success_' => true]);
                } else {
                    // dd('EDIT PLACE...');
                    Mail::bcc($writers)->send(new PendingEditReviewToEditorsMail($this->place, $user));
                    Mail::to($this->place->user->email)->send(new PendingEditReviewToUserMail($this->place, $this->place->user));
                    return redirect(route('place.preview', $this->place->slug))->with(['warning' => 'Thank you for taking your time to improve details for this place!<br>Your request is currently awaiting editor review, we\'ll drop you an email when it\'s published.']);
                }
            }
        } else {
            abort(403);
        }
    }


    public function updatedMainImagePath()
    {
        // ...
        // dd($this->main_image_path);
        $this->validate([
            'main_image_path' => 'required|mimes:png,jpg,jpeg,webp|max:5048'
        ]);

        // dd(Str::length($this->place->main_image_path));
        if ($this->place->main_image_path) {
            Storage::disk('place-images')->delete($this->place->main_image_path);
            $this->place->update([
                'main_image_path' => null,
            ]);
        }

        $img_name =  $this->place->id . '-main_photo.' .  $this->main_image_path->extension();
        $main_image_path = $this->main_image_path->storeAs('', $img_name, 'place-images');
        $this->main_image_path = 'test';
        $this->main_image_path = $main_image_path;
        $new = $this->place->update([
            'main_image_path' => $this->main_image_path,
        ]);
    }

    public function deleteMainImagePath()
    {
        if ($this->place->main_image_path) {
            Storage::disk('place-images')->delete($this->place->main_image_path);
            $this->main_image_path = null;
            $this->place->update([
                'main_image_path' => null,
            ]);
        }
    }
}
