<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RentalTest extends TestCase
{
    // DatabaseMigrations   = Running migrations agianst the database stub.
    // DatabaseTransactions = Running queries against the database stub.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group all
     * @group rental
     */
    public function testRentalInsertErrors()
    {

    }

    /**
     * GET|HEAD:  /rental
     * ROUTE:     rental.frontend.index
     *
     * @group all
     * @group frontend
     * @group rental
     */
    public function testFrontendOverView()
    {
        $route = route('rental.frontend.index');
        $this->get($route);
        $this->seeStatusCode(200);
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalInsertSuccess() {

    }

	/**
     * @group backend
	 * @group all
     * @group rental
	 */
	public function testRentalUpdateView()
	{
        $this->authentication();
	}

	/**
     * @group backend
	 * @group all
     * @group rental
	 */
	public function testRentalUpdateWithoutSuccess()
	{
		$this->authentication();
	}

	/**
     * @group backend
	 * @group all
     * @group rental
	 */
	public function testRentalUpdateWithSuccess()
	{
		$this->authentication();
	}

    /**
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalDelete()
    {
        $this->authentication();
    }

    /**
     * GET|HEAD: /rental/calendar
     * ROUTE:    rental.frontend-calendar
     * 
     * @group frontend
     * @group all
     * @group rental
     */
    public function testRentalCalendar()
    {
        $route =  route('rental.frontend-calendar');
        
        $this->get($route); 
        $this->seeStatusCode(200);
    }

    /**
     * @group all
     * @group rental
     */
    public function testRentalInsertFormFrontEnd()
    {

    }

    /**
     * GET|HEAD:  /
     * ROUTE:     rental.backend.insert
     *
     * @group rental
     * @group backend
     * @group all
     */
    public function testRentalInsertFormBackend()
    {
        $this->authentication();
    }
}
