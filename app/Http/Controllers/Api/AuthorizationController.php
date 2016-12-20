<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\AuthorizationTransformer;
use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\Fractal\Manager;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Resource\Collection;
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
     * @see:phpunit     ApiKeyManagementTest::testIndexOverviewWithoutPagination()
     * @see:phpunit     ApiKeyManagementTest::testIndexOverviewWithPagination()
     * @see:phpunit     ApiKeyManagementTest::testIndexOverviewWithoutData()
     *
     * @param  Request $request
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

        return response($content, $status)->header('Content-Type', 'application/json');
    }

    /**
     * Create or request a new api key for the application.
     *
     * @url:platform    POST: /api/authorizations/new
     * @see:phpunit     ApiKeyManagementTest::testCreateNewKeyWithErrors()
     * @see:phpunit     ApiKeyManagementTest::testCreateNewKeyWithoutErrors()
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Status
     */
    public function createKey(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validation());

        if ($validator->fails()) { // Validation fails
            $content = [
                'message' => 'Could not update the lease information',
                'http_code' => Status::HTTP_BAD_REQUEST,
                'errors' => $validator->errors()
            ];

            $content['message']   = 'De API Sleutel kon niet aangemaakt worden.';
            $content['http_code'] = Status::HTTP_BAD_REQUEST;
            $content['errors']    = $validator->errors();
            $status               = $content['http_code'];
        } else { // Validation passes.
            $insert = ApiKey::make($request->user_id);

            $update = ApiKey::find($insert->id);
            $update->service = $request->service;
            $update->save();

            $content['message']   = 'De API sleutel is toegevoegd';
            $content['http_code'] = Status::HTTP_OK;
            $content['key']       = $insert->key;

            $status = $content['http_code'];
        }

        return response($content, $status)->header('Content-Type', 'application/json');
    }

    /**
     * Regenerate the API key
     *
     * @url:platform    GET|HEAD: /api/authorizations/regenerate/{id}
     * @see:phpunit     ApiKeyManagementTest::testRegenerateKeyValid()
     * @see:phpunit     ApiKeyManagementTest::testRegenerateKeyInValid()
     *
     * @param  int $id The user id in the api_key table.
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function regenerateKey($id)
    {
        $key = ApiKey::find($id);

        if ((int) count($key) === 1) { // Key is not found into the system.
            $newKey = ApiKey::generateKey();
            $key->update(['key' => $newKey]);

            $content['message'] = 'De API sleutel is aangepast';
            $content['new_key'] = $newKey;
            $status             = Status::HTTP_OK;
        } else { // There is no key found with the id.
            $content = ['message' => 'Er is geen key met deze id gevonden.'];
            $status  = Status::HTTP_NOT_FOUND;
        }

        return response($content, $status)->header('Content-Type', 'application/json');
    }

    /**
     * Remove a key out off the system.
     *
     * @url:platform    DELETE:
     * @see:phpunit     ApiKeyManagementTest::
     * @see:phpunit     ApiKeyManagementTest::
     *
     * @param  int $id The api key id in the database.
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Status
     */
    public function deleteKey($id)
    {
        $key = ApiKey::find($id);

        if ((int) count($key) === 1) { // There is a key found with this id.
            ApiKey::destroy($id);

            $content = ['message' => 'De API Sleutel is verwijderd'];
            $status  = Status::HTTP_OK; // 200
        } else { // There is no key found with this id.
            $content = ['message' => 'Er is geen API sleuter gevonden met deze id.'];
            $status  = Status::HTTP_NOT_FOUND; // 404
        }

        return response($content, $status)->header('Content-Type', 'application/json');
    }

    /**
     * Validation class for the controller
     *
     * @return array $validation
     */
    protected function validation()
    {
        $validation['user_id']  = 'required';
        $validation['service'] = 'required';

        return $validation;
    }
}
