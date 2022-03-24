<?php

namespace App\Http\Controllers;

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

        $request->user()->places()->create([
            'title' => $request->title,
            'status' => ((isset($request->published) && Auth::can('publish place')) ? 'published' : 'pending'),
            'location' => $request->location,
            'info' => $request->info,
        ]);

        return redirect()->back();
    }

}
