<?php

namespace App\Http\Controllers\Api;

use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class RentalController
 * @package App\Http\Controllers\Api
 */
class RentalController extends ApiGuardController
{
    /**
     * RentalController constructor.
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Get all the rentals through the api interface.
     *
     *
     */
    public function index()
    {
        //
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * @param  int $id the rental id.
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param int $id the rental id.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param int $id the rental id.
     */
    public function destroy($id)
    {
        //
    }
}
