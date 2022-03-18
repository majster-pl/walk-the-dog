<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
        $places = Place::where('user_id', auth()->id())->orderByDesc('created_at')->paginate(5);
        return view("dashboard.index", [
            'places' => $places
        ]);
    }
}
