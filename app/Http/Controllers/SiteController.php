<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function show_home() {
        return view('home');
    }

    public function show_dashboard() {
        return view('dashboard');
    }    
}
