<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlacePreviewController extends Controller
{
    public function index($param)
    {
        $place = Place::where("id", $param)->orWhere('slug', $param)->get();
        if (isset($place[0])) {
            return view('place-preview.index', ['id'=> $param, 'place' => $place[0]]);
        } else {
            return abort(404);
        }
    }
}
