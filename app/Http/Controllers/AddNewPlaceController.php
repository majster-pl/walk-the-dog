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
            'address_line1' => 'required|min:3',
            'address_state_or_region' => 'required|min:3',
            'address_country' => 'required|min:3',
            'address_city' => 'required|min:3',
            'address_latitude' => 'required|min:15',
            'walk_time' => 'required',
            'parking' => 'required',
            'type_id' => 'required',
            'popularity' => 'required',
            'description' => 'required|min:10'

        ]);

        $user = User::find(Auth::id());
        $newPlace = $request->user()->places()->create([
            'title' => $request->title,
            'status' => (($request->has('status') && $user->hasRole('editor|super-user')) ? 'published' : 'pending'),
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'address_state_or_region' => $request->address_state_or_region,
            'address_city' => $request->address_city,
            'address_country' => $request->address_country,
            'address_postcode_or_zip' => $request->address_postcode_or_zip,
            'address_latitude' => $request->address_latitude,
            'walk_time' => $request->walk_time,
            'parking' => (($request->parking == "true") ? true : false),
            'parking_details' => $request->parking_details,
            'type_id' => $request->type_id,
            'popularity' => $request->popularity,

            'description' => $request->description,
        ]);

        if ($newPlace) {
            if ($request->has('status')) {
                return redirect()->back()->with('success', 'New place added successfully!');
            } else {
                return redirect()->back()->with('success', 'New place added and is now pending review...');
            }
        } else {
            return redirect()->back()->with('error', 'There was problem adding a new place... <br>Please try again later!');
        }
    }

}
