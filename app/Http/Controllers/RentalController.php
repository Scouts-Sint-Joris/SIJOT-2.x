<?php

namespace App\Http\Controllers;

use App\Mail\RentalNotification;
use App\Mail\RentalNotificationRequest;
use App\Http\Requests;
use App\Notifications\RentalInsertNotification;
use App\Rental;
use App\User;
use App\RentalStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RentalConfirmed;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

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
    /** @var mixed $authMiddleware Authencation middleware protected routes */
    protected $authMiddleware;

    /** @var Rental $rentalDb The database model for the rentals. */
    private $rentalDb;

    /**
     * RentalController constructor.
     *
     * @param   Rental $rentalDb
     * @return  void
     */
    public function __construct(Rental $rentalDb)
    {
        $this->authMiddleware = ['indexBackEnd', 'setOption', 'setConfirmed', 'destroy'];

        $this->middleware('lang');
        $this->middleware('auth')->only($this->authMiddleware);

        $this->rentalDb = $rentalDb;
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
        $data['rentals'] = $this->rentalDb->with('status')->paginate(25);
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
        $data['items'] = $this->rentalDb->whereHas('status', function ($query) {
            $query->where('name', trans('rental.confirm'));
        })->get();

        return view('rental.frontend-calendar', $data);
    }

    /**
     * [METHOD]: Set a rental status to 'Option'.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   RentalTest::testSetOptionRental();
     *
     * @param  int $rentalId the rental id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setOption($rentalId)
    {
        $status = RentalStatus::where('name', trans('rental.lease-option'))->first();

        if ($this->rentalDb->find($rentalId)->update(['status_id' => $status->id])) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.rental-option'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Set a rental status to 'confirmed'.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   RentalTest::testSetConfirmedRental()
     *
     * @param  int $rentalId the rental id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setConfirmed($rentalId)
    {
        $status = RentalStatus::where('name', trans('rental.lease-confirm'))->first();

        if ($this->rentalDb->find($rentalId)->update(['status_id' => $status->id])) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.rental-confirm'));

            // Notification
            Notification::send(User::all(), new RentalConfirmed());
        }

        return redirect()->back();
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
     * @see:phpunit   RentalTest::testRentalInsertErrors()
     * @see:phpunit   RentalTest::testRentalInsertSuccess()
     *
     * @param  Requests\RentalValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert(Requests\RentalValidator $input)
    {
        $insert = $this->rentalDb->create($input->except('_token'));
        $status = RentalStatus::where('name', trans('rental.lease-new'))->first();

        if ($this->rentalDb->find($insert->id)->update(['status_id' => $status->id])) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.rental-insert'));

            if (! auth()->check()) {
                $rental = $this->rentalDb->find($insert->id);
                $logins = User::with('permissions')->whereIn('name', ['rental'])->get();

                Mail::to($logins)->queue(new RentalNotification($rental));
                Mail::to($insert)->queue(new RentalNotificationRequest($rental));
            } elseif (auth()->check()) {
                Notification::send(User::all(), new RentalInsertNotification());
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
        $data['rental'] = $this->rentalDb->find($id);
        return view('', $data);
    }

    /**
     * [METHOD]: Update the rental in the module.
     *
     * @url:platform  PUT|PATCH:
     * @see:phpunit   RentalTest::testRentalUpdateWithoutSuccess()
     * @see:phpunit   RentalTest::testRentalUpdateWithSuccess()
     *
     * @param  Requests\RentalValidator $input
     * @param  int $id the rental id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\RentalValidator $input, $id)
    {
        $rental = $this->rentalDb->find($id);
        $rental->input($input->except('_token'));

        session()->flash('class', 'alert alert-success');
        session()->flash('message', trans('flash-session.rental-update'));

        return redirect()->back();
    }

    /**
     * [FRONT-END]: Display how reachable the domain is.
     *
     * @url:platform  GET|HEAD: /rental/reachablew
     * @see:phpunit   RentalTest::testReachablePage()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function domainReachable()
    {
        return view('rental.frontend-reachable');
    }

    /**
     * [METHOD]: Delete method for the rental method.
     *
     * @url:platform:  GET|HEAD: /rental/destroy/{id}
     * @see:phpunit    RentalTest::testRentalDelete()
     *
     * @param  int $rentalId the rental id in the database
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyLease($rentalId)
    {
        if ($this->rentalDb->destroy($rentalId)) {
            session()->flash('class', 'alert alert-sucess');
            session()->flash('message', trans('flash-session.rental-update'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Export all the rental to an excel sheet
     *
     * @url:platform  GET|HEAD: /backend/rental/export
     * @see:phpunit   RentalTest::testExport()
     *
     * @return void | Excel download
     */
    public function exportExcel()
    {
        // FIXME: Phpunit throws an error in the logs. We need to check if this also occurs
        //        On the web methods. In case of bug risk.

        Excel::create('Verhuringen-'. date('d/m/Y'), function ($excel) {

            // Sheet: for all the rentals.
            $excel->sheet('Alle', function ($sheet) {
                $all = $this->rentalDb->with('status')->get();
                $sheet->loadView('rental.export.all', compact('all'));
            });
        })->download('xls');
    }
}
