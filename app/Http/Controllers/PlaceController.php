<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
    {

        // return search page is search query present
        if ($request->sort) {
            // if ($request->sort == 'likes') {
            //     // get 3 places with most likes (will return place_id and number of likes)
            //     $ordered = Like::select('place_id')
            //         ->selectRaw('count(place_id) as qty')
            //         ->groupBy('place_id')
            //         ->orderBy('qty', 'DESC')
            //         // ->take(6)
            //         ->get();

            //     // dd($ordered);
            //     // create array and loop through ordered to add only place_id to array
            //     $order = array();
            //     foreach ($ordered as $key => $value) {
            //         $status = Place::find($value->place_id);
            //         if (isset($status->status)) {
            //             if ($status->status === "published") {
            //                 array_push($order, $value->place_id);
            //             }
            //         }
            //     }
            //     $ee = new Place();
            //     $ee->likes()->reorder('place_id');

            //     dd($ee);


            //     // query places by id to get top rated
            //     $top = Place::find([2,3,4])->paginate(5);
            //     // $places = Place::where('status', 'published')->orderBy($request->sort)->paginate(5);
            //     return view('places.index', [
            //         'places' => $top,
            //     ]);

            // }
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
            return view('places.index', [
                'places' => $places,
            ]);
        }

        $places = Place::where('status', 'published')->orderByDesc('created_at')->paginate(5);
        return view("places.index", [
            'places' => $places
        ]);
    }
}
