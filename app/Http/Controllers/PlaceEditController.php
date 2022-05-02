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
        $this->middleware(['auth', 'verified']);
    }


    public function index(Request $request)
    {
        $place = Place::where("id", $request->route('place'))->orWhere('slug', $request->route('place'))->get()->first();
        $user = User::find(Auth::id());
        $types = PlaceType::all();

        if (($place->user->id === Auth::id()) || $user->hasRole('editor|super-user')) {
            return view('edit-place.index', [
                'place' => $place,
                'placeTypes' => $types
            ]);
        } else {
            abort(401);
        }
    }

}
