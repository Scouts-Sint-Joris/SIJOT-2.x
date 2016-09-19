<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    /**
     *
     */
    public function homeFront()
    {
        return view('');
    }

    /**
     *
     */
    public function homeBackend()
    {
        return view();
    }
}
