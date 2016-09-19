<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalValidator;
use App\Http\Requests;
use App\Rental;
use Illuminate\Http\Request;

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
     * @url:platform
     * @see:phpunit   RentalTest::
     *
     * @param  int $filter the rental status parameter.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexBackEnd($filter)
    {
        if ($filter == 'new') {
            $data['rentals'] = Rental::where()->paginate(15);
        } elseif ($filter = 'bevestigd') {
            $data['rentals'] = Rental::where('', '')->paginate(15);
        } else {
            $data['rentals'] = Rental::paginate(15);
        }

        return view('', $data);
    }

    /**
     * [FRONT-END]: Front-end view for the rental Calendar
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   RentalTest::
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Calendar()
    {
        return view();
    }

    /**
     * [FRONT-END]: Front-end insert view fcr the rental view.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   Rentaltest::
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insertViewFrontEnd()
    {
        return view('');
    }

    /**
     * [METHOD]: Insert method for the rental module.
     *
     * @url:platform  POST:
	 * @see:phpunit	  RentalTest::testRentalInsertErrors()
	 * @see:phpunit   RentalTest::testRentalInsertSuccess()
     *
     * @param  RentalValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert(RentalValidator $input)
    {
        if (Rental::create($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', '');
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

		// TODO: One-To-Many relation define.

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
        Rental::destroy($id);

        session()->flash('class', 'alert alert-success');
        session()->flash('message', '');

        return redirect()->back();
    }
}
