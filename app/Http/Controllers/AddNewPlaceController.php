<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use App\Models\PlaceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddNewPlaceController extends Controller
{
    public function index()
    {
        $places = Place::where('user_id', auth()->id())->orderByDesc('created_at')->paginate(5);
        $types = PlaceType::all();

        return view("new-place.index", [
            'places' => $places,
            'placeTypes' => $types
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2',
            'main_image_path' => 'required|mimes:png,jpg,jpeg,webp|max:12048',
            'address_state_or_region' => 'required|min:3',
            'address_country' => 'required|min:3',
            'address_city' => 'required|min:3',
            'address_latitude' => 'required|min:15',
            'walk_time' => 'required',
            'parking' => 'required',
            'type_id' => 'required',
            'activity' => 'required',
            'dogs_only' => 'required',
            'seasonal_access' => 'required',
            'off_lead' => 'required',
            'cafe_access' => 'required',
            'activity' => 'required',
            'access_to_water' => 'required',
            'disposal_bins' => 'required',
            'description' => 'required|min:10'
        ]);

        $newImageName = 'main_photo-' . time() . '.' . $request->main_image_path->extension();
        $request->main_image_path->move(public_path('uploads/images'), $newImageName);

        $user = User::find(Auth::id());
        $newPlace = $request->user()->places()->create([
            'status' => (($request->has('status') && $user->hasRole('editor|super-user')) ? 'published' : 'pending'),
            'title' => $request->title,
            'main_image_path' => $newImageName,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'address_state_or_region' => $request->address_state_or_region,
            'address_city' => $request->address_city,
            'address_country' => $request->address_country,
            'address_postcode_or_zip' => $request->address_postcode_or_zip,
            'address_latitude' => $request->address_latitude,
            'walk_time' => $request->walk_time,
            'parking' => $request->parking,
            'parking_details' => $request->parking_details,
            'type_id' => $request->type_id,
            'activity' => $request->activity,
            'dogs_only' => $request->dogs_only,
            'seasonal_access' => $request->seasonal_access,
            'seasonal_details' => $request->seasonal_details,
            'off_lead' => $request->off_lead,
            'cafe_access' => $request->activity,
            'access_to_water' => $request->access_to_water,
            'disposal_bins' => $request->activity,
            'description' => $request->description,
        ]);

        // dd($newPlace);
        
        if ($newPlace) {
            if ($request->has('status')) {
                return redirect()->back()->with('success', 'New place added successfully!');
            } else {
                // return view('new-place-confirmation.index');
                return redirect('add-new-confirmation')->with('success', true);
                // return redirect()->back()->with('success', 'New place added and is now pending review...');
            }
        } else {
            return redirect()->back()->with('error', 'There was problem adding a new place... <br>Please try again later!');
        }
    }

}
