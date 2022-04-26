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
        $place = Place::find($request->route('place'));
        $user = User::find(Auth::id());
        $types = PlaceType::all();
        // if place allready review redirect to edit page with message
        if ($place->status == 'pending') {
            if (($place->user->id === Auth::id()) || $user->hasRole('editor|super-user')) {
                return view('review-place.index', [
                    'access' => true,
                    'place' => $place,
                    'placeTypes' => $types
                ]);
            } else {
                return view('review-place.index', [
                    'access' => false
                ]);
            }
        } else {
            return redirect('place/'.$place->slug)->with('success', 'This place has already been reviewed!');
        }

    }

}
