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
     * GET|HEAD:  /rental
     * ROUTE:     rental.frontend.index
     *
     * @group all
     * @group frontend
     * @group rental
     */
    public function testFrontendOverView()
    {

    }

    /**
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalInsertErrors()
    {

    }

    /**
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testReachablePage() 
    {

    }

    /**
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalInsertSuccess()
    {

    }

	/**
     * @group backend
	 * @group all
     * @group rental
	 */
	public function testRentalUpdateView()
	{

	}

	/**
     * @group backend
	 * @group all
     * @group rental
	 */
	public function testRentalUpdateWithoutSuccess()
	{

	}

	/**
     * @group backend
	 * @group all
     * @group rental
	 */
	public function testRentalUpdateWithSuccess()
	{

	}

    /**
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalDelete()
    {

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
    }

    /**
     * GET|HEAD: /rental/insert
     * ROUTE:    rental.frontend.insert
     *
     * @group frontend
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

    }
}
