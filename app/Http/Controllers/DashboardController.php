<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }

    public function profile() {
        return view('dashboard.profile', [
            'title' => 'Profile'
        ]);
    }
}
