<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use App\Models\PlaceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class PlaceEditController extends Controller
{
    use HasRoles;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        // dd($request->route('place'));
        $place = Place::find($request->route('place'));
        $user = User::find(Auth::id());
        $types = PlaceType::all();

        if (($place->user->id === Auth::id()) || $user->hasRole('editor|super-user')) {
            return view('edit-place.index', [
                'access' => true,
                'place' => $place,
                'placeTypes' => $types
            ]);
        } else {
            return view('edit-place.index', [
                'access' => false
            ]);
        }
    }

    public function edit(Request $request)
    {
        $user = User::find(Auth::id());
        $place = Place::find($request->id);
        
        $input = $request->all();
        if ($request->has('status')) {
            $input['status'] = "published";
        } else {            
            $input['status'] = $place->status === "pending" ? "pending" : "unpublished";
        }

        $this->validate($request, [
            'title' => 'required|min:2',
            // 'main_image_path' => 'required|mimes:png,jpg,jpeg|max:5048',
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

        // dd($request->parking);

        // if editor or admin, allow to publish otherwise change status to pending.
        if ($user->hasRole('editor|super-user')) {
            $update = $place->update($input);
            if (!$update) {
                return redirect()->back()->with('error', 'There was problem updating place... Please try again later!');
            } else {
                return redirect()->back()->with('success', 'Place updated successfully!');
            }
        } else if ($place->user->id === Auth::id()) {
            $input['status'] = "pending";
            $update = $place->update($input);
            if (!$update) {
                return redirect()->back()->with('error', 'There was problem updating place... Please try again later!');
            } else {
                return redirect()->back()->with('success', 'Thank you for submitting update!<br>
                New information is now under review and will be public shortly :)');
            }
        } else {
            abort(403);
        }
    }
}
