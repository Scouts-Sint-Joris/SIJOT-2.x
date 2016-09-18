<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     */
    public function index()
    {

    }

    /**
     *
     */
    public function updatePlatformSettings()
    {

    }

    /**
     *
     */
    public function updateBackUpSettings()
    {

    }
}
