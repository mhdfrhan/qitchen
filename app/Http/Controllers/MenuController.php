<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function adminIndex() {

        return view('dashboard.menu.index', [
            'title' => 'List Menu',
        ]);
    }
}
