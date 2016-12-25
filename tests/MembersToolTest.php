<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MembersToolTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD:
     * ROUTE:
     *
     * @group all
     * @group members
     */
    public function testNewMemberInsertForm()
    {
        $this->authentication();
        $this->get(route('members.create'));
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD:
     * ROUTE:
     *
     * @group all
     * @group members
     */
    public function testConfirmMember()
    {
        //
    }

    /**
     * POST:
     * ROUTE:
     *
     * @group members
     * @group all
     */
    public function testRegisterMethod()
    {
        //
    }

    /**
     * POST:
     * ROUTE:
     *
     * @group members
     * @group all
     */
    public function testRegisterValidationErrorMethod()
    {
        //
    }

    /**
     * GET|HEAD:
     * ROUTE:
     *
     * @group members
     * @group all
     */
    public function testIndexMethod()
    {
        //
    }

    /**
     * GET|HEAD:
     * ROUTE:
     *
     * @group members
     * @group all
     */
    public function testShowMethod()
    {
        //
    }

    /**
     * POST:
     * ROUTE:
     *
     * @group members
     * @group all
     */
    public function testUpdateMethod()
    {
        //
    }

    /**
     * POST:
     * ROUTE:
     *
     * @group members
     * @group all
     */
    public function testUpdateMethodValidationErrors()
    {
        //
    }

    /**
     * GET|HEAD:
     * ROUTE:
     *
     * @group members
     * @group all
     */
    public function testDeleteMethod()
    {
        //
    }
}
