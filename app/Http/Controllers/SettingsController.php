<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class SettingsController extends Controller
{
    /**
     * SettingsController constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
		return view(); 
    }

    /**
     * [METHOD]: Update the general application settings. 
	 * 
	 * @url:platform  POST: 
	 * @see:phpunit   Write phpunit test -> when validation fails. 
	 * @see:phpunit   Write phpunit test -> when validation passes.  
	 * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePlatformSettings()
    {
		return redirect()->back(); 
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBackUpSettings()
    {
		return redirect()->back();
    }
}
