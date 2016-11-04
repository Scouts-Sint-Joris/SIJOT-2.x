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
     * @url:platform  GET|HEAD: settings/env
     * @see:phpunit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['keys']   = $this->env->getContent();
        $data['backup'] = $this->env->AutoBackupEnabled();
        return view('environment.index', $data);
    }

    /**
     * [METHOD]: Create az backup for thep revious backup file.
     *
     * @url:platform GET|HEAD: /settings/env/backup
     * @see:phpunit
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createBackup()
    {
        if ($this->env->createBackup()) // Can create the backup.
        {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Created the backup file');
        }

        return redirect()->back();
    }
}
