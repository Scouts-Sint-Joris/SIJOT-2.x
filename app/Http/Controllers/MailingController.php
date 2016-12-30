<?php

namespace App\Http\Controllers;

use App\Mail\NewNewsletter;
use App\Mailing;
use App\NewsLetter;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

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
     */
    public function __construct()
    {
        $this->authMiddleware = ['registerNewsLetter', 'destroyNewsletter'];

        $this->middleware('auth')->except($this->authMiddleware);
        $this->middleware('lang');
    }

    /**
     * [BACKEND]: Index overview for the mailing module.
     *
     * @url:platform  GET|HEAD: /backend/mailing
     * @see:phpunit   MailingTest::testBackendEndIndex()
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
     * @url:platform  DELETE:  /backend/mailing/destroy/{id}
     * @see:phpunit   MailingTest::testMailingDestroy()
     *
     * @param  int $id the id for the email record in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mailingDestroy($id)
    {
        if (Mailing::destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.mailing-destroy'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Register the email to the newletter module.
     *
     * @url:platform  POST:
     * @see:phpunit   MailingTest::testNewsLetterCreateWithErrors()
     * @see:phpunit   MailingTest::testNewsLetterCreateWithoutErrors()
     *
     * @param  Requests\NewsLetterValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerNewsLetter(Requests\NewsLetterValidator $input)
    {
        $insert = NewsLetter::create($input->except('_token'));
        
        if ($insert) {
            Mail::to($insert)->send(new NewNewsletter($insert));

            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.newsletter-register'));
        }

        return redirect()->back(302);
    }

    /**
     * [METHOD]: Register the email data to mailinglists.
     *
     * @url:platform  POST:
     * @see:phpunit   MailingTest::
     * @see:phpunit   MailingTest::
     *
     * @param Requests\MailingValidator| $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerMailing(Requests\MailingValidator $input)
    {
        if (Mailing::create($input->except('_token'))) {
            // The email address for the mailing platform is created.
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.mailing-register'));
        }

        return redirect()->back(302);
    }

    /**
     * [BACKEND]: Update view for the mailing data.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   MailingTest::
     * @see:phpunit   MailingTest::
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
     * @url:platform  PUT|PATCH:
     * @see:phpunit   MailingTest::
     * @see:phpunit   MailingTest::
     *
     * @param  Requests\Mailingvalidator $input
     * @param  int $id the mailing row in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMailing(Requests\MailingValidator $input, $id)
    {
        if (Mailing::find($id)->update($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.mailing-update'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Delete a email address out of the system.
     *
     * @url:platform  GET|HEAD:  /newsletter/destroy/{id}
     * @see:phpunit   MailingTest::testNewsLetterDestroy()
     *
     * @param  string $string the checksum for the email address.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyNewsletter($string)
    {
        $data = NewsLetter::where('code', $string);

        if ($data->count() === 1) {
            $result = $data->first();
            NewsLetter::destroy($result->id);

            session()->flash('class', 'alert alert-success');
            session()->flash('message', 'The email address has been removed.');
        }

        return redirect()->back();
    }
}
