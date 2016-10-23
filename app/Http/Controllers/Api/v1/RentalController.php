<?php

namespace App\Http\Controllers\Api\v1;

use App\User;
use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class RentalController
 * @package App\Http\Controllers\Api\v1
 */
class RentalController extends Controller
{
    /**
     * RentalController constructor.
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    /**
     * Rental index.
     *
     * Get all the rentals in the system.
     *
     * @group rental
     */
    public function index()
    {

    }
}
