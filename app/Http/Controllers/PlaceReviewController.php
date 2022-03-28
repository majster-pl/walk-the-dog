<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceReviewController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->route('place'));
        $place = Place::find($request->route('place'));
        $user = User::find(Auth::id());

        if (($place->user->id === Auth::id()) || $user->hasRole('editor|super-user')) {
            return view('review-place.index', [
                'access' => true,
                'place' => $place
            ]);
        } else {
            return view('review-place.index', [
                'access' => false
            ]);
        }
    }

}
