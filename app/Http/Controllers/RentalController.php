<?php

namespace App\Http\Controllers;

use App\Mail\RentalNotification;
use App\Mail\RentalNotificationRequest;
use App\Http\Requests\RentalValidator;
use App\Http\Requests;
use App\Rental;
use App\User;
use App\RentalStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class RentalController
 *
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class RentalController extends Controller
{
    /**
     * RentalController constructor.
     */
    public function __construct()
    {
        // TODO: Set auth middleware for the backend routes.
        $this->middleware('lang');
        // TODO: User activity middleware.
    }

    /**
     * [BACK-END]: The backend side for the rental module.
     *
     * @url:platform  GET|HEAD: /backend/rental
     * @see:phpunit   RentalTest::
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexBackEnd()
    {
        $data['rentals'] = Rental::with('status')->paginate(20);
        return view('rental.backend-overview', $data);
    }

    /**
     * [FRONT-END]: front-end overview with the domain description.
     *
     * @url:platform  GET|HEAD: /rental
     * @see:phpunit   RentalTest::testFrontendOverView()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexFrontEnd()
    {
        return view('rental.frontend-overview');
    }

    /**
     * [FRONT-END]: Front-end view for the rental Calendar
     *
     * @url:platform  GET|HEAD: /rental/calendar
     * @see:phpunit   RentalTest::testRentalCalendar()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function calendar()
    {
        $data['items'] = Rental::whereHas('status', function ($query) {
            $query->where('name', 'Bevestigd');
        })->get();

        return view('rental.frontend-calendar', $data);
    }

    /**
     * [FRONT-END]: Front-end insert view fcr the rental view.
     *
     * @url:platform  GET|HEAD: /rental/insert
     * @see:phpunit   RentalTest::testRentalInsertFormFrontEnd()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insertViewFrontEnd()
    {
        return view('rental.frontend-insert');
    }

    /**
     * [METHOD]: Insert method for the rental module.
     *
     * @url:platform  POST: /rental/insert
	 * @see:phpunit	  RentalTest::testRentalInsertErrors()
	 * @see:phpunit   RentalTest::testRentalInsertSuccess()
     *
     * @param  RentalValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert(RentalValidator $input)
    {
        $insert = Rental::create($input->except('_token'));
        $status = RentalStatus::find(1);

        Rental::find($insert->id)->update(['status_id' => $status->id]);

        if ($insert) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', '');

            if (! auth()->check()) {
                $rental = Rental::find($insert->id);

                // Trigger mailable error for now. because there is no one with the role.

                // TODO: Write patch with standard platform config variable.
                // TODO: Write notification.
                $logins = User::with('permissions')->whereIn('name', ['rental']);

                Mail::to($insert)->queue(new RentalNotificationRequest($rental));
                Mail::to($logins)->queue(new RentalNotification($rental));

            }
        }

        return redirect()->back();
    }

    /**
     * [BACK-END]: Update view for the rental module.
     *
     * @url:platform  GET|HEAD:
	 * @see:phpunit   RentalTest::testRentalUpdateView()
     *
     * @param  int $id the rental id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
		$data['rental'] = Rental::find($id);
	    return view('', $data);
    }

    /**
     * [METHOD]: Update the rental in the module.
     *
     * @url:platform  PUT|PATCH:
	 * @see:phpunit   RentalTest::testRentalUpdateWithoutSuccess()
	 * @see:phpunit   RentalTest::testRentalUpdateWithSuccess()
     *
     * @param  RentalValidator $input
     * @param  int $id the rental id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RentalValidator $input, $id)
    {
        $rental = Rental::find($id);
        $rental->input($input->except('_token'));

        session()->flash('class', 'alert alert-success');
        session()->flash('message', '');

        return redirect()->back();
    }

    /**
     * [METHOD]: Delete method for the rental method.
     *
     * @url:platform:  GET|HEAD: /rental/destroy/{id}
	 * @see:phpunit    RentalTest::testRentalDelete()
	 *
     * @param  int $id the rental id in the database
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $delete = Rental::destroy($id);

        if ($delete) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', '');
        }

        return redirect()->back();
    }
}
