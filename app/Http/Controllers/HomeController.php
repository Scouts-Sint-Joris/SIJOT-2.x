<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
		$this->middleware('lang');
		$this->middleware('auth', ['only' => ['homeBackend']]);
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
        return view('welcome');
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
        return view('');
    }
}
