<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class EnvSettingsController
 * @package App\Http\Controllers
 */
class EnvSettingsController extends Controller
{
    /**
     * EnvSettingsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('auth:api')->only('getValues');
        $this->middleware('lang');
    }

    /**
     * [METHOD]: The index view for the environment settings.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('environment.index');
    }
}
