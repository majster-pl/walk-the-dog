<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceRemoveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function delete(Place $place)
    {
        Place::destroy($place->id);
        return back();
    }
}
