<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlacePublishController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function publish(Place $place)
    {
        Place::where('id', $place->id)->update(['status' => 'published']);
        return back();
    }


    public function unpublish(Place $place)
    {
        Place::where('id', $place->id)->update(['status' => 'unpublished']);
        return back();
    }
}
