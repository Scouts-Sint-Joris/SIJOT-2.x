<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Http\Requests\MembersValidator;
use App\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class MembersController extends Controller
{
    /**
     * Country database model.
     *
     * @var Country
     */
    private $countries;

    /**
     * Members database model.
     *
     * @var array
     */
    private $members;

    /**
     * User login database model.
     *
     * @var array
     */
    private $user;

    /**
     * MembersController constructor.
     *
     * @param   Country $countries
     * @param   Members $members
     * @param   User $user
     *
     * @return  void|null
     */
    public function __construct(Country $countries, Members $members, User $user)
    {
        $this->middleware('auth')->except(['create', 'store']);

        $this->countries = $countries;
        $this->members   = $members;
        $this->user      = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @url:platform    GET|HEAD:
     * @see:phpunit     MembersToolTest
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['members'] = $this->members->all();
        return view('members/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @url:platform    GET|HEAD: /members/create
     * @see:phpunit     MembersToolTest::testNewMemberInsertForm()
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = $this->countries->select('id', 'name')->get();
        return view('members/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @url:platform
     * @see:phpunit     MembersToolTest::
     * @see:phpunit     MembersToolTest::
     *
     * @param  MembersValidator $input
     * @return \Illuminate\Http\Response
     */
    public function store(MembersValidator $input)
    {
        // FIXME: Phpunit triggers false on validation.

        Log::debug($input->all());

        if ($this->members->create($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Het lid is aangemaakt in het systeem. De leiding zal de inschrijving snel bevestigen.');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @url:platform    GET|HEAD:
     * @see:phpunit     MembersToolTest::
     *
     * @param  int  $memberId
     * @return \Illuminate\Http\Response
     */
    public function show($memberId)
    {
        $data['member'] = $this->members->find($memberId);
        return view('members/show', $data);
    }

    /**
     * Confirm that a subscription is a group member.
     *
     * @url:platform    GET|HEAD:
     * @see:phpunit     MembersToolTest::
     *
     * @param  int $memberId The member id in the database.
     * @return response
     */
    public function confirm($memberId)
    {
        if ($this->members->find($memberId)) { // User is confirmed.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Het lid bevestigd in het systeem.');

            // TODO: Implement login creation for the parent.
            // TODO: Set notification to the group leaders.
            // TODO: Implement email notification to the parents.
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @url:platform    GET|HEAD:
     * @see:phpunit     MembersToolTest::
     *
     * @param  int  $memberId The member id in the database.
     * @return \Illuminate\Http\Response
     */
    public function edit($memberId)
    {
        $data['member'] = $this->members->find($memberId);
        return view('members.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @url:platform
     * @see:phpunit     MembersToolTest::
     * @see:phpunit     MembersToolTest::
     *
     * @param  MembersValidator $input
     * @param  int $memberId The member id in the database.
     * @return \Illuminate\Http\Response
     */
    public function update(MembersValidator $input, $memberId)
    {
        if (Members::find($memberId)->update($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Het Lid is gewijzigd');

            Notification::send();
            Notification::send();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @url:platform
     * @see:phpunit     MembersToolTest::
     *
     * @param  int  $memberId The member in the database.
     * @return \Illuminate\Http\Response
     */
    public function destroy($memberId)
    {
        // TODO: Add method to delete the parent if one in the system.
        //       If multiple don't delete the parent.

        $member       = $this->members->find($memberId);
        $recordDelete = $member->delete();

        if ($recordDelete) { // THe user and all the associated relations are deleted.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Het lid is verwijderd uit het systeem. Vergeet hem niet te verwijderen in de GA');
        }

        return redirect()->back(302);
    }
}
