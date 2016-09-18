<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalValidator;
use App\Http\Requests;
use App\Rental;
use Illuminate\Http\Request;

/**
 * Class RentalController
 * @package App\Http\Controllers
 *
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
        // TODO: Implement language middleware
        // TODO: User activity middleware.
    }

    /**
     * [BACK-END]: The backend side for the rental module.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  int $filter the rental status parameter.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexBackEnd($filter)
    {
        if ($filter == 'new') {
            $data['rentals'] = '';
        } elseif ($filter = 'bevestigd') {
            $data['rentals'] = '';
        } else {
            $data['rentals'] = '';
        }

        return view('', $data);
    }

    /**
     * [FRONT-END]: Front-end view for the rental Calendar
     *
     * @url:platform
     * @see:phpunit
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
     * @url:platform
     * @see:phpunit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insertView()
    {
        return view();
    }

    /**
     * [METHOD]: Insert method for the rental module.
     *
     * @url:platform
     * @see:phpunit  TODO: Wrtie test when validation passes.
     * @see:phpunit  TODO: Write test when validation fails
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
     * @url:platform
     * @see:phpunit
     *
     * @param  int $id the rental id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view();
    }

    /**
     * [METHOD]: Update the rental in the module.
     *
     * @url:platform
     * @see:phpunit   TODO: write test when validation passes.
     * @see:phpunit   TODO: write test when validation fails
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
     * @url:platform:  GET|HEAD:
     * @see:phpunit
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
