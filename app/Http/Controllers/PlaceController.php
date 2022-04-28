<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        // sort places if requeted
        if ($request->sort) {
            switch ($request->sort) {
                case 'created_at':
                case 'status':
                    $places = Place::where('status', 'published')->orderByDesc($request->sort)->paginate(5);
                    break;

                default:
                    $places = Place::where('status', 'published')->orderBy($request->sort)->paginate(5);
                    break;
            }
            return view('places.index', [
                'places' => $places,
            ]);
        }

        $places = Place::where('status', 'published')->orderBy('title')->paginate(5);
        return view("places.index", [
            'places' => $places
        ]);
    }
}
