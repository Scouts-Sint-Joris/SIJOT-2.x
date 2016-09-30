<?php

namespace App\Http\Controllers;

use App\News;
use App\Tags;
use App\Http\Requests;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
    }


    public function index()
    {

    }

    public function store()
    {

    }

    public function BackendShow($id)
    {

    }

    /**
     * [METHOD]: 
     * 
     * @param  string $id the news item id in the database. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function draft($id)
    {
        if (News::find($id)->update(['state' => 0])) {
            session()->flash('class', ''); 
            session()->flash('message', ''); 
        } 

        return redirect()->back();
    }
  
    public function publish($id)
    {
        if (News::find($id)->update(['state' => 1])) {
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
