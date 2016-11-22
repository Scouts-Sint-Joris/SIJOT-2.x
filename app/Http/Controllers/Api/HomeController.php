<?php

namespace App\Http\Controllers\Api;

use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers\Api
 */
class HomeController extends ApiGuardController
{
    /**
     * Get the frontpage for the api.
     *
     * @url:platform  GET|HEAD:  /api
     * @see:phpunit   HomeTest::testApiHome
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index()
    {
        return $this->response->withArray([
            'data' => [
                'group' => config('app.name'),
                'admin' => 'Tim Joosten',
                'version' => '1.0.0',
            ]
        ]);
    }
}
