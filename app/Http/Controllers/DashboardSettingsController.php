<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.settings');
    }
}
