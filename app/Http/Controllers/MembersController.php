<?php

namespace App\Http\Controllers;

use App\Country;
use App\Members;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    // FIXME: Set the flash messages to translations files.

    /**
     * MembersController constructor.
     *
     * @return void.
     */
    public function __constrict()
    {
        $this->middleware('auth');
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
     * @url:platform
     * @see:phpunit
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = Country::select('id', 'name')->get();
        return view('members/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @url:platform
     * @see:phpunit
     * @see:phpunit
     *
     * @param  \App\Http\Requests\MemberValidator  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MembersValidator $input)
    {
        if (Members::create($input->except('_token'))) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['member'] = Members::find($id);
        return view('members/show', $data);
    }

    /**
     * Confirm that a subscription is a group member.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  int $id The member id in the database.
     * @return response
     */
    public function confirm($id)
    {
        $member = Members::find($id);

        // FIXME: $members is here to supress the syntax error.
        if ($members) { // User is confirmed.
            session()->flash('', '');
            session()->flash('', '');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @url:platform
     * @see:phpunit
     * @see:phpunit
     *
     * @param  \App\Http\Requests\MemberValidator  $request
     * @param  int  $id The member id in the database.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
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
    }
}
