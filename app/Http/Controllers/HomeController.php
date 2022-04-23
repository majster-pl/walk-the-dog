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
            $places = Place::whereRaw('concat(title," ",description," ",address_city, " ",address_country) like ?', "%{$request->search}%")->where('status', '=', 'published')->get();
            // dd($places);
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
            ->take(6)
            ->get();

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
        // get places in correct order and marge results together
        $top1 = isset($order[0]) ? Place::where('id', $order[0])->get() : [];
        $top2 = isset($order[1]) ? Place::where('id', $order[1])->get() : [];
        $top3 = isset($order[2]) ? Place::where('id', $order[2])->get() : [];
        $top = is_object($top1) ? $top1->merge($top2)->merge($top3) : null;

        return view('home.index', [
            'recent' => $recent,
            'top' => $top
        ]);
    }
}
