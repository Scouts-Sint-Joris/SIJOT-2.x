<?php

namespace App\Http\Controllers\auth;

use App\User;
use App\Themes;
use App\Http\Requests;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileInfoValidator;
use App\Http\Requests\SecurityInfoValidator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
     * @see:phpunit   AccountTest::testUpdateView()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $data['themes'] = Themes::all();
        $data['user'] = User::find($userId);
        $data['keys'] = ApiKey::where('user_id', $data['user']->id)->get();

        return view('auth.profile', $data);
    }

    /**
     * [BACK-END]: Update the profile information.
     *
     * @url:platform  POST: /settings/profile
     * @see:phpunit   AccountTest::testUpdateInformation()
     *
     * @param  ProfileInfoValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(ProfileInfoValidator $input)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        if ($user->update($input->except(['avatar', '_token']))) {
            // Check if we can do the update

            if ($input->hasFile('avatar')) {
                // The user want a new avatar.
                $avatar = public_path(auth()->user()->avatar);

                if (file_exists($avatar)) {
                    // Check if the file exists on the server. If true delete this file.
                    File::delete($avatar);
                }

                $image = $input->file('avatar');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('assets/avatars/' . $filename);

                // For windows servers.
                // Image::make($image->getLinkTarget())->resize(160, 160)->save($path);

                // For linux based servers.
                Image::make($image->getRealPath())->resize(160, 160)->save($path);

                // Save the avatar path to the database.
                $user->avatar = 'assets/avatars/' . $filename;
                $user->save();
            }

            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('auth.FlashInfo'));
        }

        return redirect()->back();
    }


    /**
     * [BACK-END]: Update the security settings for the account.
     *
     * @url:platform  POST: /settings/profile/security
     * @see:phpunit   AccountTest::testUpdateSecurity()
     *
     * @param  SecurityInfoValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(SecurityInfoValidator $input)
    {
        $userId = auth()->user()->id;
        $filters = ['_token', 'password_confirmation'];

        if (User::find($userId)->update($input->except($filters))) {
            // The record has been updated
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('auth.FlashSec'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Create a key for the background api.
     *
     * @url:platform  POST: /settings/api/key
     * @see:phpunit   AccountTest::testCreateKeyWithoutErrors()
     * @see:phpunit   AccountTest::
     *
     * @param  Requests\ApiKeyValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createKey(Requests\ApiKeyValidator $input)
    {
        $insert = ApiKey::make($input->userid);

        $update = ApiKey::find($insert->id);
        $update->service = $input->service;

        if ($insert && $update->save()) {
            // The token and service name are stored.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The api token has been created');
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Regenerate a API key.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  int $id The api key id.
     * @param  ApiKey $apiKey
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RegenerateKey(ApiKey $apiKey, $id)
    {
        if ($apiKey->find($id)->update(['key' => $apiKey->generateKey()])) {
            // There is a new key generated.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The api key has been generated.');
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Destroy a api key.
     *
     * @param  ApiKey $apiKey
     * @param  int $id the api key id.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyKey($id, ApiKey $apiKey)
    {
        if ($apiKey->destroy($id)) {
            // The api key is destroyed
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The api key has been deleted');
        }

        return redirect()->back();
    }
}
