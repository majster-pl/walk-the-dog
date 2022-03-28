<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class DashboardAllPlacesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $places = Place::orderByDesc('created_at')->paginate(5);
        return view("dashboard.allPlaces", [
            'places' => $places
        ]);
    }
}
