<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlacePreviewController extends Controller
{
    public function index($param)
    {
        $place = Place::where("id", $param)
            ->orWhere('slug', $param)
            ->get()
            ->first();

        if (isset($place)) {
            if (Auth::check()) {
                if ($place->belongsTo(Auth::user()) || User::user()->hasRole('editor') || $place->status == 'published') {
                    return view('place-preview.index', ['id' => $param, 'place' => $place]);
                } else {
                    return abort(404);
                }
            } else {
                if ($place->status == 'published') {
                    return view('place-preview.index', ['id' => $param, 'place' => $place]);
                } else {
                    return abort(404);
                }
            }
        }
    }
}
