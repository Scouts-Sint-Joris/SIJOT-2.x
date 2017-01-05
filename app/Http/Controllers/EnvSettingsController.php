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
     * @param  DotenvEditor $env
     * @return Void
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
        $data['keys']    = $this->env->getContent();
        $data['backups'] = $this->env->getBackupVersions();

        return view('environment.index', $data);
    }

    /**
     * [METHOD]: Create a backup for the previous backup file.
     *
     * @url:platform GET|HEAD: /settings/env/backup
     * @see:phpunit
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createBackup()
    {
        if ($this->env->createBackup()) {
            // Can create the backup.

            /**
             * @todo: create notification.
             * ---
             * alse so for the option that users,
             * can set an option taht they wont mail the backup or not.
             */

            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Created the backup file');
        } else {
            session()->flash('class', 'alert alert-danger');
            session()->flash('message', 'Could not create the settings backup');
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Dlete a environment setting key.
     *
     * @param  string $param The key that neews to be delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEnvKey($param)
    {
        $input = $this->env->getValue($param);

        if ($this->env->deleteData($input)) {
            // The key is deleted.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The evironment setting key has been deleted');
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Delete a settings backup.
     *
     * @param  int $timestamp The unformatted timestamp from the backup.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteBackup($timestamp)
    {
        if ($this->env->deleteBackup($timestamp)) {
            // The env backup is destroyed.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The backup file has been deleted.');
        }

        return redirect()->back();
    }
}
