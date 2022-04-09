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

    public function index(Request $request)
    {
        // return search page is search query present
        if ($request->sort) {
            switch ($request->sort) {
                case 'created_at':
                case 'status':
                    $places = Place::orderByDesc($request->sort)->paginate(5);
                    break;
 
                default:
                    $places = Place::orderBy($request->sort)->paginate(5);
                    break;
            }
            // dd($places);
            return view('dashboard.allPlaces', [
                'places' => $places,
            ]);
        }


        $places = Place::orderByDesc('created_at')->paginate(5);
        return view("dashboard.allPlaces", [
            'places' => $places
        ]);
    }
}
