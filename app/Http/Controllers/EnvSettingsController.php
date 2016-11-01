<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Brotzka\DotenvEditor\DotenvEditor;
use Illuminate\Http\Request;

/**
 * Class EnvSettingsController
 * @package App\Http\Controllers
 */
class EnvSettingsController extends Controller
{
    /**
     * @var DotenvEditor
     */
    private $env;

    /**
     * EnvSettingsController constructor.
     *
     * @param DotenvEditor $env The env directory values.
     */
    public function __construct(DotenvEditor $env)
    {
        $this->middleware('auth')->only('index');
        $this->middleware('auth:api')->only('getValues');
        $this->middleware('lang');

        $this->env = $env;
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

    public function getValues()
    {

    }
}
