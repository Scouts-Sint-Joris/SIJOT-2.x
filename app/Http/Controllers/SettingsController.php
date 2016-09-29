<?php

namespace App\Http\Controllers;

use App\Http\Requests\BackUpSettingsValidator;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
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
		return view('settings.index');
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
        dd($input->all()); // For debugging propose.

        session()->flash('class', 'alert alert-success');
        session()->flash('message', '');

		return redirect()->back();
    }

    /**
     * [METHOD]: Update the environment settings.
     *
     * @url:platform
     * @see:phpunit
     * @see:phpunit
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEnvironmentSettings()
    {

    }

    /**
     * @param  BackUpSettingsValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBackUpSettings(BackUpSettingsValidator $input)
    {
		dd($input->all()); // For debugging propose

		session()->flash('class', 'alert alert-success');
		session()->flash('message', '');

		return redirect()->back();
    }
}
