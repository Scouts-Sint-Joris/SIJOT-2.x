<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\AuthorizationTransformer;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as Status;

/**
 * Class AuthorizationController
 * @package App\Http\Controllers\Api
 */
class AuthorizationController extends ApiGuardController
{
    /**
     * AuthorizationController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all the api keys into the system.
     *
     * @url:platform    GET|HEAD: /api/authorizations
     * @see:phpunit
     * @see:phpunit
     * @see:phpunit
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $fractal = new Manager();

        if ($currentCursorStr = $request->input('cursor', false)) {
            $keys = ApiKey::where('id', '>', $currentCursorStr)->take(5)->get();
        } else {
            $keys = ApiKey::take(5)->get();
        }

        if ((int) count($keys) > 0) { // There are keys found.
            $prevCursorStr = $request->input('prevCursor', 6);
            $newCursorStr  = $keys->last()->id;

            $cursor   = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $keys->count());
            $resource = new Collection($keys, new AuthorizationTransformer);

            $resource->setCursor($cursor);
            $content = $fractal->createData($resource)->toJson();
            $status  = Status::HTTP_OK;
        } elseif((int) count($keys) === 0) { // There are no keys found.
            $content = ['message' => 'There are no keys found'];
            $status  = Status::HTTP_OK;
        }

        return response($content, $status)
            ->headers('Content-Type', 'application/json');
    }

    /**
     * Create or request a new api key for the application.
     *
     * @url:platform
     * @see:phpunit
     * @see:phpunit
     *
     * @return mixed
     */
    public function createKey()
    {

    }

    /**
     * Validation class for the controller
     *
     * @return array $validation
     */
    protected function validation()
    {
        $validation['userid']  = 'required';
        $validation['servive'] = 'required';

        return $validation;
    }
}
