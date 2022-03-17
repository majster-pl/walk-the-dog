<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

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
            'location' => 'required|min:5',
            'info' => 'required|min:3'
        ]);

        $request->user()->places()->create([
            'status' => 'pending',
            'location' => $request->location,
            'info' => $request->info,
        ]);

        return redirect()->back();
    }

}
