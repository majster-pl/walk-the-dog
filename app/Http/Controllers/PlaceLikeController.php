<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function store(Place $place, Request $request)
    {
        if ($place->likedBy($request->user())) {
            return response(null, 409);
        }
        $place->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Place $place, Request $request)
    {
        $request->user()->likes()->where('place_id', $place->id)->delete();
        // dd($place);
        // $place->likes()->destroy();
        return back();
    }
}
