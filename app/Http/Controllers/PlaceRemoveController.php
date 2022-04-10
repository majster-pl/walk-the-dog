<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceRemoveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function delete(Place $place)
    {
        $user = User::find(Auth::id());
        if ($user->hasRole('editor') || ($place->user_id == $user->id)) {
            Place::destroy($place->id);
            return back()->with('success', 'Place removed successfully.');
        } else {
            return back()->with('error', 'Unable to proceed with this request...');
        }
    }
}
