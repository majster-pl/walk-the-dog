<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $all_users = User::with('roles')->get();
        return view("dashboard.users", [
            'users' => $all_users
        ]);
    }
}
