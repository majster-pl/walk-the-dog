<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class AddNewPlaceController extends Controller
{
    public function index()
    {
        return view("new-place.index");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'location' => 'required|min:5',
            'info' => 'required|min:3'
        ]);

        $request->user()->places()->create($request->only(['location', 'info']));
    }
}
