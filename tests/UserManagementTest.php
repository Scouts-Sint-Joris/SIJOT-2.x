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
		$this->get(); 
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
