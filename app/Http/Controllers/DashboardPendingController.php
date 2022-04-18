<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class DashboardPendingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function index()
    {
        $places = Place::where('status', 'pending')->orderByDesc('created_at')->paginate(5);
        return view("dashboard.pending", [
            'places' => $places
        ]);
    }
}
