<?php

namespace App\Http\Controllers\Api;

use App\Activity;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ActivityController
 * @package App\Http\Controllers\Api
 */
class ActivityController extends ApiGuardController
{
    /**
     * ActivityController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    /**
     *
     */
    public function show()
    {

    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function create(Request $request)
    {

    }

    /**
     * Change a activity through the api.
     *
     * @param  Request $input
     * @param  int $id the activity id in the database.
     * @return mixed
     */
    public function edit(Request $input, $id)
    {

    }

    /**
     * Destroy a activity in the database.
     *
     * @url:platform
     * @see:phpunit
     * @see:phpunit
     *
     * @param  int $id The activity in the database.
     * @return mixed
     */
    public function destroy($id)
    {
        if (! Activity::destroy($id)) {
            return $this->response->errorNotFound();
        }

        return response(['message' => 'De activiteit is verwijderd'], Status::HTTP_OK)
            ->header('Content-Type', 'application/json');
    }

    /**
     * return array Validation criteria
     *
     * @return array $criteria
     */
    protected function validationCriteria()
    {
        $criteria['state']       = 'required';
        $criteria['group']       = 'required';
        $criteria['data']        = 'required';
        $criteria['start_time']  = 'required';
        $criteria['end_date']    = 'required';
        $criteria['description'] = 'required';
        $criteria['heading']     = 'required';

        return $criteria;
    }
}
