<?php

namespace App\App\Http\Controllers;

use App\App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        return view('home.index');
    }
}
