<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Get index page
    public function index() {
        return view ('pages.index');
    }


}
