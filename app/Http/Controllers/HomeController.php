<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Place;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // get recently added places
        $recent = Place::latest()->where('status', '=', 'public')->take(3)->orderByDesc('created_at')->get();

        // get 3 places with most likes (will return place_id and number of likes)
        $ordered = Like::select('place_id')
            ->selectRaw('count(place_id) as qty')
            ->groupBy('place_id')
            ->orderBy('qty', 'DESC')
            ->take(3)
            ->get();

        // create array and loop through ordered to add only place_id to array
        $order = array();
        foreach ($ordered as $key => $value) {
            array_push($order, $value->place_id);
        }
        // query places by id to get top rated
        $top = Place::whereIn('id', $order)->get();

        return view('home.index', [
            'recent' => $recent,
            'top' => $top
        ]);
    }
}
