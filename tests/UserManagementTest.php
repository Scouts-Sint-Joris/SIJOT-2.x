<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagementTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD:  /backend/users
     * ROUTE: users.index
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testOverview()
    {
        $this->authentication();
        $this->get(route('users.index'));
        $this->see('Overzicht.');
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD:
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testCreateViewBackend()
    {
        $this->authentication();
        $this->get(route('users.create'));
        $this->seeStatusCode(200);
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
        $this->post(route('auth.new'), []);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
        $this->seeStatusCode(302);
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
        $session['class']   = 'alert alert-success';
        $session['message'] = '';

        $input['name']  = 'Test user';
        $input['email'] = 'Test@example.be';

        $this->authentication();
        $this->dontSeeInDatabase('users', $input);
        $this->post(route('auth.new'), $input);
        $this->seeInDatabase('users', $input);
        $this->seeStatusCode(302);
        $this->session($session);
    }

    /**
     * GET|HEAD: /backend/users/destroy/1
     * ROUTE:    users.destroy
     *
     * @group all
     * @group auth
     * @group backend
     */
    public function testDeleteMethod()
    {
        $routeParam = ['id' => $this->user->id];

        $session['class']   = 'alert alert-success';
        $session['message'] = '';

        $this->authentication();
        $this->seeInDatabase('users', $routeParam);
        $this->get(route('users.destroy', ['id' => $this->user['id']]));
        $this->dontSeeInDatabase('users', $routeParam);
        $this->seeStatusCode(302);
        $this->session($session);
    }
}
