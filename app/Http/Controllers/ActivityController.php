<?php

namespace App\Http\Controllers;

use App\Groups;
use App\Activity;
use App\Http\Requests;
use App\Http\Requests\ActivityValidator;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * ActivityController constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
    }

    /**
     * [BACK-END]: Get the activity overview.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   ActivityControllerTest::testOverview()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['drafts']    = 0;
        $data['published'] = 0;
        $data['groups']    = Groups::all();

        return view('activity.index', $data);
    }

    /**
     * [METHOD]: Store a new activity in the database.
     *
     * @url:platform  POST:
     * @see:phpunit   ActivityControllerTest::testInsertWithError()
     * @see:phpunit   ActivityControllerTest::testInsertWithOutError()
     *
     * @param  Requests\ActivityValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ActivityValidator $input)
    {
        $create = Activity::create($input->except(['_token', 'state']));

        if ($create) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', '');
        }

        return redirect()->back();
    }

    /**
     * [BACK-END]: Update view for a activity.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   ActivityControllerTest::testEditView()
     *
     * @param  int $id the activity id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data['activity'] = Activity::find($id);
        return view('', $data);
    }


    /**
     * [METHOD]: Update a activity in the database.
     *
     * @url::platform  PUT|PATCH:
     * @see:phpunit    ActivityControllerTest::testUpdateWithError()
     * @see:phpunit    ActivityControllerTest::testUpdateWithOutError()
     *
     * @param  Requests\ActivityValidator $input
     * @param  int $id the activity id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ActivityValidator $input, $id)
    {
        $activity = Activity::find($id); 


        return redirect()->back();
    }

    /**
     * [METHOD]: Destroy a activity.
     *
     * @url:platform  GET|HEAD: /backend/activity/destroy/{id}
     * @see:phpunit   ActivityControllertest::testDestroyActivity()
     *
     * @param  int $id the activity id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);

        if (Activity::destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', '');
        }

        return redirect()->back();
    }
}
