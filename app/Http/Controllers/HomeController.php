<?php

namespace App\Http\Controllers;

use App\News;
use App\User;
use App\Activity;
use Illuminate\Http\Request;

/**
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class HomeController extends Controller
{
    /** @var Collection $newsDb      The database model for the news items. */
    private $newsDb;

    /** @var Collection $activityDb The database model for the activities. */
    private $activityDb;

    /** @var Collection $userDb      The database model for the users */
    private $userDb;

    /**
     * HomeController constructor.
     *
     * @param  App\News     $newsDb
     * @param  App\Activity $activityDb
     * @param  App\User     $userDb
     * @return Void
     */
    public function __construct(News $newsDb, Activity $activityDb, User $userDb)
    {
        $this->middleware('lang');
        $this->middleware('auth', ['only' => ['homeBackend']]);

        // Params init.
        $this->newsDb     = $newsDb;
        $this->activityDb = $activityDb;
        $this->userDb     = $userDb;
    }

    /**
     * [FRONT-END]: Get the front-end index page.
     *
     * @url:platform  GET|HEAD: /
     * @see:phpunit   HomeTest::testHomeFrontend()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeFront()
    {
        $data['news']       = $this->newsDb->where('state', 1)->paginate(4);
        $data['activities'] = $this->activityDb->with(['groups', 'creator'])
            ->where('state', 1)
            ->orderBy('date', 'ASC')
            ->paginate(25)
            ->take(6);

        return view('welcome', $data);
    }

    /**
     * [BACK-END]: Get the backend home view for the website.
     *
     * @url:platform  GET|HEAD: /home
     * @see:phpunit   HomeTest::testHomeBackend()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeBackend()
    {
        $data['users'] = $this->userDb->all();
        return view('backend', $data);
    }
}
