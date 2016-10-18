<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupControllerTest extends TestCase
{
    // DatabaseMigrations   = Used to run the database migrations stubs.
    // DatabaseTransactions = Used to run the database transactions to the db stub.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group all
     * @group frontend
     * @group groups
     */
    public function testOverview()
    {

    }

    /**
     * @group all 
     * @group frontend
     * @group groups
     */
    public function testEditForm()
    {

    }

    /**
     * @group all 
     * @group frontend 
     * @group groups
     */
    public function testUpdateMethod()
    {

    }

    /**
     * GET|HEAD:
     * ROUTE:
     *
     * @group all
     * @group frontend
     * @group groups
     */
    public function testSpecific()
    {
        $group = factory(App\Groups::class)->create(['selector' => 'kapoenen']);
    }
}
