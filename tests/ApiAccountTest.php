<?php

use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiAccountTest extends TestCase
{
    // DatabaseMigrations   = Used to run the database migrations.
    // DatabaseTransactions = Used to run the queries against the database.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group all
     * @group account
     * @group api
     */
    public function testAccountDetails()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group account
     * @group api
     */
    public function testAccountDetailsInvalidId()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * ROUTE:
     *
     * @group all
     * @group account
     * @group api
     */
    public function testAccountUpdateInfoWithErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group account
     * @group api
     */
    public function testAccountUpdateUnfoWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group account
     * @group api
     */
    public function testAccountUpdateSecurityWithErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group account
     * @group api
     */
    public function testAccountUpdateSecurityWIthoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }
}
