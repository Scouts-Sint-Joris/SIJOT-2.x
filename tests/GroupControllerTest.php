<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class GroupControllerTest
 */
class GroupControllerTest extends TestCase
{
    // DatabaseTransactions = Used for running the queries against the database.
    // DatabaseMigrations   = Used for migrating the database tables.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD:
     * ROUTE:
     *
     * @group frontend
     * @group all
     * @group groups
     */
    public function testFrontEndOverview()
    {
        $route = route('frontend.groups');

        $this->get($route);
        $this->seeStatusCode(200);

    }

    /**
     * @group frontend
     * @group groups
     * @group all
     */
    public function testFrontEndSpecific()
    {

    }

    /**
     *
     */
    public function updateMethod()
    {

    }
}