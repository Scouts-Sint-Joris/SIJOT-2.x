<?php

namespace App\Http\Controllers\Api;

use App\Activity;
use App\Http\Transformers\ActivityTransformer;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as Status;

/**
 * Class ActivityController
 * @package App\Http\Controllers\Api
 */
class ActivityController extends ApiGuardController
{
    // FIXME: Add proper docblocks about platform urls and tests.
    // FIXME: Set the output data to translation files.
    // FIXME: Avoid static access to classes.

    /**
     * ActivityController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all the activities through the api.
     *
     * @url:platform
     * @see:phpunit
     *
     * @return void
     */
    public function index()
    {

    }

    /**
     * Show a specific aactivity thro)ugh the api.
     *
     * @url:platform    GET|HEAD:
     * @see:phpunit
     * @see:phpunit
     *
     * @param  int      $activityId  The id off the activity in the database.
     * @return mixed
     */
    public function show($activityId)
    {
        $activity = Activity::find($activityId);

        if ((int) count($activity) === 1) { // Record is found.
            $content  = $this->response->withItem($activity, new ActivityTransformer());
            return response($content, Status::HTTP_OK)->header('Content-Type', 'application/json');
        }

        return $this->response->errorNotFound();
    }

    /**
     * Create a new activity through the api.
     *
     * @param  Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validationCriteria());
        $headers['Content-Type'] = 'application/json';

        if ($validation->fails()) { // The validation fails
            $content['message']     = 'Kan de activiteit niet aanmaken.';
            $content['http_code']   = Status::HTTP_BAD_REQUEST;
            $content['errors']      = $validation->errors();

            return $this->response->withArray($content, $headers);
        }

        Activity::create($request->all());

        $creation = [
            'message' => 'De activiteit is aangemaakt.',
            'http_code' => Status::HTTP_CREATED,
        ];

        return $this->response->withArray($creation, $headers);
    }

    /**
     * Change a activity through the api.
     *
     * @url:platform
     * @see:phpunit
     * @see:phpunit
     *
     * @param  Request $input
     * @param  int      $activityId the activity id in the database.
     * @return mixed
     */
    public function edit(Request $input, $activityId)
    {
        $validation = Validator::make($input->all(), $this->validationCriteria());
        $headers['Content-Type'] = 'application/json';

        if ($validation->fails()) { // Validator fails.
            $content['message']   = 'Wij konden de activiteit niet aanpassen.';
            $content['http_code'] = Status::HTTP_BAD_REQUEST;
            $content['errors']    = $validation->errors();

            return $this->response->withArray($content, $headers);
        }

        $activity = Activity::find($activityId);

        if ((int) count($activity) === 1) { // Record is found
            $activity->update($input->all());

            $editMsg['message']   = 'De activiteit is aangepast';
            $editMsg['http_code'] = Status::HTTP_CREATED;

            return $this->response->withArray($editMsg, $headers);
        }

        return $this->response->errorNotFound();
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
    public function destroy($activityId)
    {
        if (! Activity::destroy($activityId)) {
            return $this->response->errorNotFound();
        }

        return response(['message' => 'De activiteit is verwijderd'], Status::HTTP_OK)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Return array Validation criteria
     *
     * @return array $criteria
     */
    protected function validationCriteria()
    {
        $criteria['state']       = 'required';
        $criteria['group']       = 'required';
        $criteria['date']        = 'required';
        $criteria['start_time']  = 'required';
        $criteria['end_date']    = 'required';
        $criteria['description'] = 'required';
        $criteria['heading']     = 'required';

        return $criteria;
    }
}
