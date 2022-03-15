<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddNewPlaceController extends Controller
{
    public function index() {
        return view("new-place.index");
    }
}
