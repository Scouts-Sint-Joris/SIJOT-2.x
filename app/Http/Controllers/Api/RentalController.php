<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\LeaseTransformer;
use App\Rental;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use League\Fractal\Manager;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Resource\Collection;
use Symfony\Component\HttpFoundation\Response as Status;

/**
 * Class RentalController
 * @package App\Http\Controllers\Api
 */
class RentalController extends ApiGuardController
{
    /** @var Rental $rentalDb The rental database model. */
    private $rentalDb;

    /**
     * RentalController constructor.
     *
     * @return Void
     */
    public function __construct()
    {
        parent::__construct();
        $this->rentalDb = $rentalDb;
    }

    /**
     * Get all the rentals through the api interface.
     *
     * @url:platform  GET|HEAD: /api
     * @see:phpunit
     *
     * @param  Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $fractal = new Manager();

        if ($currentCursorStr = $request->input('cursor', false)) {
            $rentals = $this->rentalDb->where('id', '>', $currentCursorStr)->take(5)->get();
        } else {
            $rentals = $this->rentalDb->take(5)->get();
        }

        if (count($rentals) > 0) { // There are rentals found.
            $prevCursorStr = $request->input('prevCursor', 6);
            $newCursorStr  = $rentals->last()->id;

            $cursor   = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $rentals->count());
            $resource = new Collection($rentals, new LeaseTransformer);

            $resource->setCursor($cursor);
            $content = $fractal->createData($resource)->toJson();
            $status  = Status::HTTP_OK;
        } elseif (count($rentals) === 0) { // There are no rentals found.
            $content = ['message' => 'Er zijn geen verhuringen'];
            $status  = Status::HTTP_OK;
        }

        return response($content, $status)->header('Content-Type', 'application/json');
    }

    /**
     * Store a new rental through the api interface.
     *
     * @url:platform  POST: /api/rental
     * @see:phpunit
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationCriteria());
        $headers['Content-Type'] = 'application/json';

        if ($validator->fails()) {
            // Validation fails.
            $content = [
                'message' => 'Could not process the insert.',
                'http_code' => Status::HTTP_BAD_REQUEST,
                'errors' => $validator->errors()
            ];

            return $this->response->withArray($content, $headers);
        }

        // Validation passes proceed controller.
        $this->rentalDb->create($request->all());

        return $this->response->withArray([
            'message' => 'De verhuring is aangemaakt.',
            'http_code' => Status::HTTP_CREATED,
        ], $headers);
    }

    /**
     * Update a rental throught the api.
     *
     * @url:platform  PUT|PATCH:
     * @see:phpunit
     *
     * @param  Request $request
     * @param  int $id the rental id.
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->validationCriteria());
        $headers['Content-Type'] = "application/json";

        if ($validator->fails()) {
            // Validation fails.
            $content['message']     = 'Could not update the lease information';
            $content['http_code']   = Status::HTTP_BAD_REQUEST;
            $content['errors']      = $validator->errors();

            return response($content, Status::HTTP_BAD_REQUEST)
                ->header('Content-Type', 'application/json');
        }

        try {
            $this->rentalDb->findOrFail($id)->update($request->all());

            $content['message']   = 'De verhuring is gewijzigd.';
            $content['http_code'] = Status::HTTP_OK;

            return response($content, Status::HTTP_OK)
                ->header('Content-Type', 'application/json');
        } catch (ModelNotFoundException $exception) {
            return $this->response->errorNotFound();
        }
    }


    /**
     * Show a specific lease through the rental API interface.
     *
     * @url:platform  GET|HEAD: /api/rental/1
     * @see:phpunit
     *
     * @param  int $id the rental id.
     * @return mixed
     */
    public function show($id)
    {
        try {
            $lease = $this->rentalDb->findOrFail($id);
            $content = $this->response->withItem($lease, new LeaseTransformer());

            return response($content, Status::HTTP_OK)->header('Content-Type', 'application/json');
        } catch (ModelNotFoundException $exception) {
            return $this->response->errorNotFound();
        }
    }

    /**
     * Delete a lpease out off the system.
     *
     * @url:platform  DELETE: /azpi/rental/{id}
     * @see:phpunit
     *
     * @param  int $id the rental id.
     * @return \Illuminate\Contracts\Routing\ResponseFactory|mixed|Status
     */
    public function destroy($id)
    {
        if (! Rental::destroy($id)) {
            return $this->response->errorNotFound();
        }

        return response(['message' => 'De verhuring is verwijderd'], Status::HTTP_OK)
            ->header('Content-Type', 'application/json');
    }

    /**
     * The validation criteria for the rental API section.
     *
     * @return array $criteria
     */
    protected function validationCriteria()
    {
        $criteria['start_date'] = 'required';
        $criteria['end_date']   = 'required';
        $criteria['group']      = 'required';
        $criteria['email']      = 'required';

        return $criteria;
    }
}
