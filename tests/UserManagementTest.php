<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagementTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     *
     */
    public function testOverview()
    {

    }

    /**
     *
     */
    public function testCreateView()
    {

    }

    /**
     * POST:  /backend/users
     * ROUTE: auth.new
     *
     * - with validation erroros
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testCreateMethodWithError()
    {

    }

    /**
     *
     */
    public function testCreateMethodWithoutErrors()
    {

    }

    /**
     *
     */
    public function testDeleteMethod()
    {

    }
}
