<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\ProfileInfoValidator;
use App\Http\Requests\SecurityInfoValidator;
use App\User;
use App\Themes; 
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class AccountController
 *
 * @package   App\Http\Controllers\auth
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('lang'); 
    }

    /**
     * [BACK-END]: Get the profile view.
     *
     * @url:platform  GET|HEAD: settings/profile
     * @see:phpunit   TODO: Write test.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userId         = auth()->user()->id;
        $data['themes'] = Themes::all();
        $data['user']   = User::find($userId); 
        
        return view('auth.profile', $data);
    }

    /**
     * [BACK-END]: Update the profile information.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  ProfileInfoValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(ProfileInfoValidator $input)
    {
        $userId = auth()->user()->id;

        if (User::find($userId)->update($input->except('_token'))){
            session()->flash('class',   'alert alert-success');
            session()->flash('message', trans('auth.FlashInfo'));
        }

        return redirect()->back();
    }


    /**
     * [BACK-END]: Update the security settings for the account.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  SecurityInfoValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(SecurityInfoValidator $input)
    {
        $userId = auth()->user()->id;

        session()->flash('class', 'alert alert-success');
        session()->flash('message', '');

        return redirect()->back();
    }
}
