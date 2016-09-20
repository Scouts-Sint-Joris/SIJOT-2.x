<?php

namespace App\Http\Controllers;

use App\Http\Requests\BackUpSettingsValidator;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * 
 */
class SettingsController extends Controller
{
    /**
     * SettingsController constructor
     */
    public function __construct()
    {
		$this->middleware('lang');
        $this->middleware('auth');
    }

    /**
     * [BACK-END]: Get the update view for the application settings. 
     * 
     * @url:platform  GET|HEAD: 
     * @see:phpunit 
     * @see:phpunit 
     * 
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
        session()->flash('class', 'alert alert-success'); 
        session()->flash('message', '');
		return redirect()->back();
    }

    /**
     * @param  BackUpSettingsValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBackUpSettings(BackUpSettingsValidator $input)
    {
		dd($input->all()); // For debugging propose 

		session()->flash('class', '');
		session()->flash('message', '');

		return redirect()->back();
    }
}
