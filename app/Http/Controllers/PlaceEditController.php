<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
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

        if (($place->user->id === Auth::id()) || $user->hasRole('editor|super-user')) {
            return view('edit-place.index', [
                'access' => true,
                'place' => $place
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
        $this->validate($request, [
            'title' => 'required|min:2',
            'location' => 'required|min:5',
            'info' => 'required|min:3'
        ]);

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
