<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\MembersValidator;
use App\Members;
use Illuminate\Http\Request;
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
     * MembersController constructor.
     *
     * @param   Country $countries
     * @param   Members $members
     * @return  Void|null
     */
    public function __construct(Country $countries, Members $members)
    {
        $this->middleware('auth')->except(['create', 'store']);

        $this->countries = $countries;
        $this->members  = $members;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @see:phpunit
     * @see:phpunit
     *
     * @param  MembersValidator $input
     * @return \Illuminate\Http\Response
     */
    public function store(MembersValidator $input)
    {
        if ($this->members->create($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Het lid is aangemaakt in het systeem. De leiding zal de inschrijving snel bevestigen.');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @url:platform
     * @see:phpunit
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
     * @url:platform
     * @see:phpunit
     *
     * @param  int $memberId The member id in the database.
     * @return response
     */
    public function confirm($memberId)
    {
        $member = $this->members->find($memberId);

        // FIXME: $members is here to supress the syntax error.
        if ($member) { // User is confirmed.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Het lid bevestigd in het systeem.');

            // TODO: Set notification to the group leaders.
            // TODO: Implement email notification to the parents.
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  int  $id The member id in the database.
     * @return \Illuminate\Http\Response
     */
    public function edit($memberId)
    {
        $data['member'] = $this->member->find($memberId);
        return view('members/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @url:platform
     * @see:phpunit
     * @see:phpunit
     *
     * @param  MembersValidator $input
     * @param  int $id The member id in the database.
     * @return \Illuminate\Http\Response
     */
    public function update(MembersValidator $input, $id)
    {
        if (Members::find($id)->update($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Het Lid is gewijzigd');

            Notification::send();
            Notification::send();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  int  $id The member in the database.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Members::find($id);

        $recordDelete = $member->delete();
        $parentDelete = $member->parents()->sync([]);

        if ($recordDelete && $parentDelete) { // THe user and all the associated relations are deleted.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'Het lid is verwijderd uit het systeem. Vergeet hem niet te verwijderen in de GA');
        }

        return redirect()->back(302);
    }
}
