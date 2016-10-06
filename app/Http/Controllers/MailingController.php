<?php

namespace App\Http\Controllers;

use App\Mailing;
use App\NewsLetter;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Class RentalController
 *
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class MailingController extends Controller
{
    /**
     * Auth middleware routes.
     *
     * @var array
     */
    protected $authMiddleware;

    /**
     * MailingController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authMiddleware = ['index'];

        // Middleware
        // $this->middleware('auth');
        $this->middleware('auth')->only($this->authMiddleware);
        $this->middleware('lang');
    }

    /**
     * [BACKEND]: Index overview for the mailing module.
     * 
     * @url:platform 
     * @see:phpunit
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['newsletter'] = NewsLetter::paginate(25); 
        $data['mailing']    = Mailing::paginate(25);  

        return view('mailing.index', $data);        
    }

    /**
     * [METHOD]: Delete a mailing record out of the database. 
     * 
     * @param  int $id the id for the email record in the database.  
     * @return \Illuminate\Http\RedirectResponse
     */
    public function MailingDestroy($id) 
    {
        if (Mailing::destroy($id)) // Check if the mailing record is deleted.
        {
            session()->flash('class', 'alert alert-success'); 
            session()->flash('message', trans('flash-session.mailing-destroy'));
        }

        return redirect()->back(); 
    }

    /**
     * [METHOD]: Register the email to the newletter module.
     *
     * @url:platform  POST
     * @see:phpunit   TODO: create test when validation fails.
     * @see:phpunit   TODO: create test when validation passes.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerNewsLetter(Request $input)
    {
        // TODO: Create notification to the inserted email address.
        //       In the notification the user must un subscribe his email.
        $insert = NewsLetter::create($input->except('_token'));

        if ($insert) // Check if the newsletter email is inserted.
        {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.newsletter-register'));
        }

        return redirect()->back(302);
    }

    /**
     * [METHOD]: Register the email data to mailinglists. 
     *
     * @param  Request $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerMailing(Request $înput) 
    {
        $create = Mailing::create($input->except('_token'));

        if ($create) // Create the email address for the mailing platform.  
        {
            session()->flash('class', 'alert alert-success'); 
            session()->flash('message', trans('flash-session.mailing-register'));
        }

        return redirect()->back(); 
    }
    
    /**
     * [BACKEND]: Update view for the mailing data. 
     * 
     * @url:platform 
     * @see:phpunit 
     * @see:phpunit
     * 
     * @param  Int $id the mailing record in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editMailing($id) 
    {
        $data['mailing'] = Mailing::find($id);
        return view('', $data);  
    }

    /**
     * [METHOD]: Update the mailing address in the database. 
     * 
     * @url:platform 
     * @see:phpunit 
     * @see:phpunit
     *
     * @param  Requests\Mailingvalidator $input
     * @param  int $id the mailing row in the database. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMailing(Requests\MailingValidator $input, $id) 
    {
        $insert = Mailing::find($id)->update($input->except('_token'));
            
        if ($insert) // Mailing details insert check.
        {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.mailing-update'));
        }
        
        return redirect()->back(); 
    }

    /**
     * [METHOD]: Delete a email address out of the system.
     *
     * @url:platform GET|HEAD:
     * @see:phpunit
     * @see:phpunit
     *
     * @param  string $string the checksum for the email address.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyNewsletter($string)
    {
        $data = NewsLetter::where('string', $string);

        if ($data->count() === 1) // Delete control function.
        {
            $data->destroy();

            session()->flash('class', 'alert alert-success');
            session()->flash('message', '');
        }

        return redirect()->back();
    }
}
