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

    public function users() {
        return view('dashboard.users', [
            'title' => 'Users'
        ]);
    }

    public function kitchen() {
        return view('dashboard.kitchen.index', [
            'title' => '| Kitchen'
        ]);
    }

    public function kasir() {
        return view('dashboard.kasir.index', [
            'title' => '| Kasir'
        ]);
    }

    public function reports() {
        return view('dashboard.reports', [
            'title' => 'Reports'
        ]);
    }
}
