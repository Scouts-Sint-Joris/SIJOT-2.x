<?php

namespace App\Http\Controllers;

use App\Groups;
use Illuminate\Http\Request;
use App\Http\Requests\GroupValidator;
use App\Http\Requests;

/**
 * 
 */
class GroupController extends Controller
{
    /**
     * GroupController constuctor
     */
    public function __construct()
	{
		$this->middleware('lang');
		// TODO: set the authencation middleware.
	}

	/**
	 * [FRONT-END]: Display all the scouting groups. 
	 * 
	 * @url:platform  GET|HEAD: 
	 * @see:phpunit   GroupControllerTest::
	 * 
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function overview()
	{
        // TODO: Controller needs debugging.
        
        $groups = Groups::all(['selector']);
        // dd($groups);
        
        foreach ($groups as $group) {
            $data[$group->selector] = Groups::getGroup($group->selector)->get();
        }
        
		return view('', $data);
	}

	/**
	 * [FRONT-END]: Get a specific group and display them.
	 * 
	 * @url:platform  GET|HEAD: 
	 * @see:phpunit   GroupControllerTest::
	 *
	 * @param  string $param the gorup identifier in the database.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function specific($string)
	{
		$data['data'] = '';
		return view('', $data);
	}

	/**
	 * [BACK-END]: Update for a group. 
	 * 
	 * @url:platform  GET|HEAD: 
	 * @see:phpunit   GroupControllerTest::
	 * 
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit()
	{
		return view('', $data);
	}

	/**
	 * [METHOD]: Update a group description.
	 *
	 * @url:platform  PUT|PATCH:
	 * @see:phpunit   GroupControllerTest:: 
	 * @see:phpunit   GroupControllerTest::
	 *
	 * @param  GroupValidator $input
	 * @param  string $param The group selector in the database.
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(GroupValidator $input, $param)
	{
		$group = Groups::where('selector', $param);
		
		if ($group->update($input->except('_token'))) {
			session()->flash('class', 'alert alert-success');
			session()->flash('message',  '');
		}
	}
}
