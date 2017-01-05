<?php

namespace App\Http\Controllers\Api;

use App\Activity;
use App\Http\Transformers\ActivityTransformer;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Resource\Collection;
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

    /** @var Activity $activity Activity Database model. */
    private $activity;

    /**
     * ActivityController constructor.
     *
     * @param   Activity $activity
     * @return  void
     */
    public function __construct(Activity $activity)
    {
        parent::__construct();
        $this->activity = $activity;
    }

    /**
     * Get all the activities through the api.
     *
     * @url:platform
     * @see:phpunit
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $fractal = new Manager();

        if ($currentCursorStr = $request->input('cursor', false)) {
            $rentals = $this->activity->where('id', '>', $currentCursorStr)->take(5)->get();
        } else {
            $rentals = $this->activity->take(5)->get();
        }

        if ((int) count($rentals) > 0) { // There are rentals found.
            $prevCursorStr = $request->input('prevCursor', 6);
            $newCursorStr  = $rentals->last()->id;

            $cursor   = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $rentals->count());
            $resource = new Collection($rentals, new ActivityTransformer);

            $resource->setCursor($cursor);
            $content = $fractal->createData($resource)->toJson();
            $status  = Status::HTTP_OK;
        } elseif ((int) count($rentals) === 0) { // There are no rentals found.
            $content = ['message' => 'Er zijn geen activiteiten'];
            $status  = Status::HTTP_OK;
        }

        return response($content, $status)->header('Content-Type', 'application/json');
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
        $activity = $this->activity->find($activityId);

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

        $this->activity->create($request->all());

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

        $activity = $this->activity->find($activityId);

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
        if (! $this->activity->destroy($activityId)) {
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
