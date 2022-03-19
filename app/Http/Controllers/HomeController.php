<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recent = Place::latest()->take(3)->orderByDesc('created_at')->get();
        // return view("home.index");
        return view("home.index", [
            'recent' => $recent
        ]);
    }
}
