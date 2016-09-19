<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 *
 */
class HomeController extends Controller
{
    /**
     * HomeController constructor. 
     */
    public function __construct()
    {
		$this->middleware('lang');
		$this->middleware('auth', ['only' => ['homeFront']]); 
    }

    /**
     * [FRONT-END]: Get the front-end index page.
	 *
	 * @url:platform 
	 * @see:phpunit 
	 * 
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
