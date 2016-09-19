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
     * - with validation errors
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testCreateMethodWithError()
    {
        $this->authentication();
    }

    /**
     * POST:  /backend/users
     * ROUTE: auth.new
     *
     * - without validation errors
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testCreateMethodWithoutErrors()
    {
        $this->authentication();
    }

    /**
     *
     */
    public function testDeleteMethod()
    {
        $routeParam = ['id' => $this->user->id];

        $session['class']   = 'alert alert-success';
        $session['message'] = '';

        $this->authentication();
        $this->seeInDatabase('users', $routeParam);
        $this->visit(route('user.destroy', $routeParam));
        $this->dontSeeInDatabase('users', $routeParam);
        $this->seeStatusCode(200);
        $this->session($session);
    }
}
