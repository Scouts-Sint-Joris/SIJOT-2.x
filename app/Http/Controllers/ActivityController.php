<?php

namespace App\Http\Controllers;

use App\Groups;
use App\Activity;
use App\Http\Requests;
use App\Http\Requests\ActivityValidator;
use Illuminate\Http\Request;
use XMLWriter;

class ActivityController extends Controller
{
    /** @var array $inputFilter Inputs not included in the mass-assigns.*/
    protected $inputFilter;

    /** @var array $dbRelations. MySQL database relations array. */
    protected $dbRelations;

    /**
     * ActivityController constructor
     */
    public function __construct(Activity $activityDb)
    {
        $this->inputFilter = ['_token', 'group'];   // Fill in the filter array for the inputs.
        $this->dbRelations = ['groups', 'creator']; // The MySQL database relations.

        $this->middleware('auth')->except('rssFeed');   // See if the user is logged in.
        $this->middleware('lang');                      // Determine the language and get the correct trans. files.

        $this->activityDb = $activityDb;
    }

    /**
     * [BACK-END]: Get the activity overview.
     *
     * @url:platform  GET|HEAD: /backend/activity
     * @see:phpunit   ActivityControllerTest::testOverview()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Activity states.
        // 0 = draft
        // 1 = publish

        $data['drafts'] = $this->activityDb->with($this->dbRelations)
            ->where('state', 0)
            ->orderBy('date', 'ASC')
            ->paginate(25);

        $data['published'] = $this->activityDb->with($this->dbRelations)
            ->where('state', 1)
            ->orderBy('date', 'ASC')
            ->paginate(25);

        $data['groups'] = Groups::all();

        return view('activity.index', $data);
    }

    /**
     * [METHOD]: Store a new activity in the database.
     *
     * @url:platform  POST: /backend/activity
     * @see:phpunit   ActivityControllerTest::testInsertWithError()
     * @see:phpunit   ActivityControllerTest::testInsertWithOutError()
     *
     * @param  Requests\ActivityValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ActivityValidator $input)
    {
        // For DEBUGGING propose.
        // dd($input->all());

        $inputs = array_merge(['user_id' => auth()->user()->id], $input->except($this->inputFilter));
        $create = $this->activityDb->create($inputs);

        $this->activityDb->find($create->id)->groups()->attach($input->group);

        if ($create) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.activity-store'));
        }

        return redirect()->back();
    }

    /**
     * Get the rss feed for the activity.
     *
     * @url:platform    GET|HEAD: /activity/rss
     * @see:phpunit     ActivityControllerTest::testRssFeed();
     *
     * @return mixed
     */
    public function rssFeed()
    {
        // Query.
        $query = $this->activityDb->with($this->dbRelations)
            ->where('state', 1)
            ->orderBy('date', 'ASC')
            ->get();

        // dd($query);  // For debugging propose.
        // die();       // For debugging propose.

        // Start xml rendering.
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument();
        $xml->startElement('activiteiten');

        foreach ($query as $activity) {
            $start = strtotime('H:i', $activity->start_time);
            $end   = strtotime('H:i', $activity->end_time);

            $xml->startElement('activiteit');
            $xml->writeAttribute('id', $activity->id);
            $xml->writeAttribute('Naam', $activity->heading);
            $xml->writeAttribute('datum', strtotime('d/m/Y', $activity->date));
            $xml->writeAttribute('uren', $start . ' - ' . $end);
            $xml->writeAttribute('Beschrijving', $activity->description);
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();

        $content = $xml->outputMemory();
        $xml = null;

        return response($content)->header('Content-Type', 'text/xml');
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
        $data['activity'] = $this->activityDb->find($id);
        return view('', $data);
    }


    /**
     * [METHOD]: Update a activity in the database.
     *
     * @url::platform  PUT|PATCH: /backend/activity/update/{id}
     * @see:phpunit    ActivityControllerTest::testUpdateWithError()
     * @see:phpunit    ActivityControllerTest::testUpdateWithOutError()
     *
     * @param  Requests\ActivityValidator $input
     * @param  int $id the activity id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ActivityValidator $input, $id)
    {
        $activity = $this->activityDb->find($id);
        $inputs   = array_merge(['user_id' => auth()->user()->id], $input->except($this->inputFilter));
        $update   = $activity->update($inputs);

        if ($update) {
            session()->flash('success', 'alert alert-success');
            session()->flash('message', trans('flash-session.activity-update'));
        }

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
        if ($this->activityDb->destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.activity-destroy'));
        }

        return redirect()->back();
    }
}
