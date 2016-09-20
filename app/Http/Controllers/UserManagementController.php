<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

/**
 * Class UserManagementController
 *
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class UserManagementController extends Controller
{
    /**
     * UserManagementController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
        // TODO: Implement user activity middleware.
    }

    /**
     * [BACK-END]: backend user management overview.
     *
     * @url:platform  GET|HEAD: /backend/users
     * @see:phpunit   UserManagementTest::testOverview()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function overview()
    {
		$data['users'] = User::paginate(15);
        return view('users.index', $data);
    }

    /**
     * [BACK-END] Backend view for creating a new user.
     *
     * @url:platform  GET|HEAD: backend/users/create
     * @see:phpunit   UserManagementTest::testCreateViewBackend()
	 *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * [METHOD]: Insert a new login into the database.
     *
     * @url:platform  POST: /backend/users
     * @see:phpunit   UserManagementTest::testCreateMethodWithoutErrors()
     * @see:phpunit   UserManagementTest::testCreateMethodWithError()
     *
     * @param LoginValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginValidator $input)
    {
        if (User::create($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', '');
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Delete a user out off the system.
     *
     * @url:platform  GET|HEAD: /backend/users/destroy/{id}
     * @see:phpunit   UserManagementTest::testDeleteMethod()
     *
     * @param  int $id the login id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
		if (User::destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', '');
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: block a user login
     *
     * @param  int $id the login id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block($id)
    {
		session()->flash('class', '');
		session()->flash('message', '');

        return redirect()->back();
    }

    /**
     * [METHOD]: Unblock a user login.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  int $id the login id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock($id)
    {
		session()->flash('class', 'alert alert-success');
		session()->flash('message', '');

        return redirect()->back();
    }
}
