<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\NewUser;
use App\Http\Requests;
use App\Http\Requests\LoginValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $password = ['password' => bcrypt(str_random(16))];
        $newUser  = User::create($input->except('_token'));

        $findNewUser = User::find($newUser->id);
        $setPass     = $findNewUser->update($password);

        if ($newUser && $setPass) {
            // TODO: Build up the mail.
            Mail::to($findNewUser->email)->send(new NewUser($findNewUser));

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
        $user = User::find($id);
        $user->revokePermissionTo('active');
        $user->givePermssionTo('blocked');

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
        $user = User::find($id);
        $user->revokePermissionTo('blocked');
        $user->givePermissionTo('active');

		session()->flash('class', 'alert alert-success');
		session()->flash('message', '');

        return redirect()->back();
    }
}
