<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers    = User::count();
        $totalProducts = \App\Models\Product::count();

        return view('dashboard', compact('totalUsers', 'totalProducts'));
    }
}