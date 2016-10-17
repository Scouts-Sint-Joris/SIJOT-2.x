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
        $this->authentication();
        $this->visit(route('rental.frontend.index'));
        $this->seeStatusCode(200);
        $this->see('Verhuur info.');
    }

    /**
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalInsertErrors()
    {
        $this->authentication();
        $this->post(route('rental.store'), []);
        $this->seeStatusCode(302);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
    }

    /**
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testReachablePage() 
    {
        $this->authentication();
        $this->visit(route('rental.frontend.reachable'));
        $this->seeStatusCode(200);
        $this->see('Verhuur bereikbaarheid');
    }

    /**
     * @group frontend
     * @group backend
     * @group all
     * @group rental
     */
    public function testRentalInsertSuccess()
    {
        factory(App\RentalStatus::class)->create([
            'name' => 'Nieuwe aanvraag',
            'class' => 'label label-danger'
        ]);

        $user = factory(App\User::class)->create();

        $this->actingAs($user)->visit(route('rental.store'))
            ->type('2016-10-14 14:50:51', 'start_date')
            ->type('2016-10-14 14:50:51', 'end_date')
            ->type('Cubbs', 'group')
            ->type('tjoosten@gmail.com', 'email')
            ->type('08132009384', 'phone_number')
            ->press('Aanvragen')
            ->seePageIs(route('rental.frontend.insert'))
            ->see('Verhuur aanvraag.');
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
        $this->authentication();
        $this->visit(route('rental.frontend.insert'));
        $this->seeStatusCode(200);
        $this->see('Verhuur aanvraag.');
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
        $this->visit(route('rental.backend'));
        $this->seeStatusCode(200);
        $this->see('Verhuring toevoegen.');
    }
}
