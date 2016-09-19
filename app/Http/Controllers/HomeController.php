<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 
 */
class HomeController extends Controller
{
    public function __construct()
    {
		$this->middleware('lang'); 
    }

    /**
     * [FRONT-END]: 
     */
    public function homeFront()
    {
        return view('');
    }

    /**
     * [BACK-END]: Get the backend home view fgor the website. 
	 *
	 * @url:platform  GET|HEAD: 
	 * @see:phpunit 
	 *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeBackend()
    {
        return view();
    }
}
