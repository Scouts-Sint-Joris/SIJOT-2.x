<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\LeaseTransformer;
use App\Rental;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * @url:platform /api
     * @see:phpunit
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $fractal = new Manager();

        if ($currentCursorStr = $request->input('cursor', false)) {
            $rentals = Rental::where('id', '>', $currentCursorStr)->take(5)->get();
        } else {
            $rentals = Rental::take(5)->get();
        }

        if (count($rentals) > 0) {
            $prevCursorStr = $request->input('prevCursor', 6);
            $newCursorStr  = $rentals->last()->id;

            $cursor   = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $rentals->count());
            $resource = new Collection($rentals, new LeaseTransformer);

            $resource->setCursor($cursor);
            $content = $fractal->createData($resource)->toJson();
            $status  = Status::HTTP_OK;
        } elseif (count($rentals) === 0) {
            $content = ['message' => 'Er zijn geen verhuringen'];
            $status  = Status::HTTP_OK;
        }

        return response($content, $status)->header('Content-Type', 'application/json');
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