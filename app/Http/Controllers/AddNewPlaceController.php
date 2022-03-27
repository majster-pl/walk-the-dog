<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddNewPlaceController extends Controller
{
    public function index()
    {
        $places = Place::where('user_id', auth()->id())->orderByDesc('created_at')->paginate(5);
        return view("new-place.index", [
            'places' => $places
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2',
            'location' => 'required|min:5',
            'info' => 'required|min:3'
        ]);

        // dd($request->published);

        $user = User::find(Auth::id());


        $newPlace = $request->user()->places()->create([
            'title' => $request->title,
            'status' => ((isset($request->published) && $user->hasRole('publish place|super-user')) ? 'published' : 'pending'),
            'location' => $request->location,
            'info' => $request->info,
        ]);

        if ($newPlace) {
            return redirect()->back()->with('success', 'New place added successfully!');
        } else {
            return redirect()->back()->with('error', 'There was problem adding a new place... <br>Please try again later!');
        }
    }

}
