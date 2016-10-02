<?php

namespace App\Http\Controllers;

use App\News;
use App\Tags;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class NewsController
 *
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class NewsController extends Controller
{
    /**
     * NewsController constructor. 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
    }

    /**
     * [BACKEND]: 
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

    }
    
    /**
     * [BACKEND]: 
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() 
    {
        return view();
    }

    /**
     * [METHOD]:
     * 
     * @url:platform 
     * @see:phpunit 
     * @see:phpunit
     * 
     * @param  Requests\NewsValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($input)
    {
        return redirect()->back();
    }

    /**
     * [BACKEND]: Show a specific news item. 
     * 
     * @url:platform  GET|HEAD:
     * @see:phpunit
     * 
     * @param  int $id the news item id in the database. 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BackendShow($id)
    {
        $data['item'] = News::find($id);
        return view(); 
    }
    
    /**
     * [BACKEND]: 
     * 
     * @url:platform
     * @see:phpunit
     * 
     * @param  String $id The news id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) 
    {
        $data['item'] = News::find($id);
        return view('', $data); 
    }
    
    /**
     * [METHOD]: 
     * 
     * @url:platform 
     * @see:phpunit 
     * @see:phpunit
     * 
     * @param  Requests\NewsValidator $input
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function update(Requests\Newsvalidator $input, $id)
    {
        $update = News::findOrFail($id)->update($input->except('_token')); 
        
        if ($update) {
            session()->flash('class', 'alert alert-success'); 
            session()->flash('message', '');
        }
        
        return redirect()->back();
    }

    /**
     * [METHOD]: 
     * 
     * @url:platform 
     * @see:phpunit
     * 
     * @param  string $id the news item id in the database. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function draft($id)
    {
        if (News::findOrFail($id)->update(['state' => 0])) {
            session()->flash('class', ''); 
            session()->flash('message', ''); 
        } 

        return redirect()->back();
    }
  
    /**
     * [METHOD]: 
     * 
     * @see:platform 
     * @see:phpunit
     * 
     * @param  integer  $id the news item id in the database. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish($id)
    {
        if (News::findOrFail($id)->update(['state' => 1])) {
            session()->flash('class', 'alert alert-danger'); 
            session()->flash('message', '');
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Delete a news post.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  int $id The news post id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (News::destroy($id)) {
            session()->flash('class', 'alert alert-danger');
            session()->flash('message', '');
        }

        return redirect()->back();
    }
}
