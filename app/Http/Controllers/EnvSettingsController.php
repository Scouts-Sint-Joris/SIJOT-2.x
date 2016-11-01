<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class EnvSettingsController extends Controller
{
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
     * [METHOD]: Update the environment settings.
     *
     * @url:platform  PUT|PATCH:
     * @see:phpunit   SettingsTest::
     * @see:phpunit   SettingsTest::
     *
     * @param  Requests\EnvironmentValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEnvironmentSettings(Requests\EnvironmentValidator $input)
    {
        dd($input->all()); // For debugging propose.

        session()->flash('class', 'alert alert-success');
        session()->flash('message', trans('flash-session.update-environment'));

        return redirect()->back(302);
    }
}
