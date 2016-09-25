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
        // For testing out the 6 selectors. We need 6 factories.
        // Each factory for one group selector.
        $kapoenen   = factory(App\Groups::class)->create(['selector' => 'kapoenen']);
        $welpen     = factory(App\Groups::class)->create(['selector' => 'welpen']);
        $jonggivers = factory(App\Groups::class)->create(['selector' => 'jonggivers']);
        $givers     = factory(App\Groups::class)->create(['selector' => 'givers']);
        $jins       = factory(App\Groups::class)->create(['selector' => 'jins']);
        $leiding    = factory(App\Groups::class)->create(['selector' => 'leiding']);

        // There are 6 groups.
        // So test all the six groups out,
        // With 6 param calls
         
    }
}
