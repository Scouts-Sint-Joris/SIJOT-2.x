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
     * EnvController constructor.
     *
     * @param DotenvEditor $env
     */
    public function __construct(DotenvEditor $env)
    {
        $this->middleware('auth');
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
        $data['keys'] = $this->env->getContent();
        return view('environment.index', $data);
    }
}
