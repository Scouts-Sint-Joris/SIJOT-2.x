<?php

use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ApiRentalTest
 */
class ApiRentalTest extends TestCase
{
    // DatabaseMigrations   = Used to run the database migrations.
    // DatabaseTransactions = Used to run the database transactions.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group api
     * @group all
     */
    public function testRentalIndex()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalInsertErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalInsertWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalUpdateWithErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalUpdateWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalDeleteValidId()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalDeleteInvalidId()
    {
        $apiKey = factory(ApiKey::class)->create();
    }
}
