<?php

namespace App\Http\Controllers;

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
     * [METHOD]: Update the general application settings.
     *
     * @url:platform  PUT|PATCH:
     * @see:phpunit   SettingsTest::
     * @see:phpunit   SettingsTest::
     *
     * @param  Requests\SettingsUpdateValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePlatformSettings(Requests\SettingsUpdateValidator $input)
    {
        dd($input->all()); // For debugging propose.

        session()->flash('class', 'alert alert-success');
        session()->flash('message', trans('flash-session.update-platform'));

        return redirect()->back(302);
    }

    /**
     * [BACK-END]: Get the update view for the application settings.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   SettingsTest::
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * [METHOD]: Update the database backup settings.
     *
     * @url:platform  PUT|PATCH:
     * @see:phpunit   SettingsTest::
     * @see:phpunit   SettingsTest::
     *
     * @param  Requests\BackUpSettingsValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBackUpSettings(Requests\BackUpSettingsValidator $input)
    {
        dd($input->all()); // For debugging propose

        session()->flash('class', 'alert alert-success');
        session()->flash('message', trans('flash-session.update-backup'));

        return redirect()->back(302);
    }
}
