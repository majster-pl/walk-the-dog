<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use App\Models\PlaceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
        // dd($request->route('place'));
        $place = Place::where("id", $request->route('place'))->orWhere('slug', $request->route('place'))->get()->first();

        // $place = Place::find($request->route('place'));
        $user = User::find(Auth::id());
        $types = PlaceType::all();
        // if place allready review redirect to edit page with message
        if ($user->hasRole('editor|super-user')) {
            if ($place->status == 'pending') {
                return view('review-place.index')->with([
                    'access' => true,
                    'place' => $place,
                    'placeTypes' => $types
                ]);
            } else {
                return redirect(route('place.preview', $place->slug))->with('success', 'This place has already been reviewed!');
            }
        } else {
            abort(403);
        }
    }
}
