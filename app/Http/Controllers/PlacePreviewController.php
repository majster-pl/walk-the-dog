<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlacePreviewController extends Controller
{
    public function index($id)
    {
        $place = Place::where("id", $id)->get();
        return view('place-preview.index', ['id'=> $id, 'place' => $place]);
    }
}
