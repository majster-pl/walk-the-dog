<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Place;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // get recently added places
        $recent = Place::latest()->where('status', '=', 'published')->take(3)->orderByDesc('created_at')->get();

        // return search page is search query present
        if ($request->search) {
            $places = Place::whereRaw('concat(title," ",info," ",location) like ?', "%{$request->search}%")->get();
            return view('search.index', [
                'search' => $places,
                'recent' => $recent
            ]);
        }

        // get recently added places
        $recent = Place::latest()->where('status', '=', 'published')->take(3)->orderByDesc('created_at')->get();

        // get 3 places with most likes (will return place_id and number of likes)
        $ordered = Like::select('place_id')
            ->selectRaw('count(place_id) as qty')
            ->groupBy('place_id')
            ->orderBy('qty', 'DESC')
            // ->take(6)
            ->get();

            // dd($ordered);
        // create array and loop through ordered to add only place_id to array
        $order = array();
        foreach ($ordered as $key => $value) {
            $status = Place::find($value->place_id);
            if (isset($status->status)) {
                if (($status->status === "published") && (count($order) < 3)) {
                    array_push($order, $value->place_id);
                }
            }
        }
 
        // query places by id to get top rated
        $top = Place::find($order);

        return view('home.index', [
            'recent' => $recent,
            'top' => $top
        ]);
    }
}
