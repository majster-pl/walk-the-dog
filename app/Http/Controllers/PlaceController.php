<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::where('status', 'public')->orderByDesc('created_at')->paginate(5);
        return view("places.index", [
            'places' => $places
        ]);
    }
}
