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
    public function testRegisterMethodNoValidationError()
    {
        $input['firstname']          = 'John';
        $input['lastname']          = 'Doe';
        $input['gender']            = 'Male';
        $input['email']             = 'jhonDoe@example.tld';
        $input['birth_date']        = '10/10/1995';
        $input['bank_number']       = '000/000/000/000';
        $input['country']           =  1;
        $input['city']              = 'city';
        $input['street']            = 'Street name';
        $input['house_number']      = '1';
        $input['house_sub_number']  = '1';
        $input['mobile_number']     = '0000/00.00.00';
        $input['description']       = 'Description';

        $session['class']   = 'alert alert-success';
        $session['message'] = 'Het lid is aangemaakt in het systeem. De leiding zal de inschrijving snel bevestigen.';

        $this->authentication();
        $this->post(route('members.store'), $input);
        $this->seeStatusCode(302);
        $this->seeInDatabase('members', $input);
        $this->session($session);
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
        $this->post(route('members.store'), []);
        $this->seeStatusCode(302);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
    }

    /**
     * GET|HEAD: /members/index
     * ROUTE:    members.index
     *
     * @group members
     * @group all
     */
    public function testIndexMethod()
    {
        $this->authentication();
        $this->get(route('members.index'));
        $this->seeStatusCode(200);
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
        $members = factory(App\Members::class)->create();

        $this->authentication();
        $this->get(route('members.show', ['memberId' => $members->id]));
        $this->seeStatusCode(200);
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
     * GET|HEAD: /members/delete/{memberId}
     * ROUTE:    members.delete
     *
     * @group members
     * @group all
     */
    public function testDeleteMethod()
    {
        $members = factory(App\Members::class)->create();

        $session['class']   = 'alert alert-success';
        $session['message'] = 'Het lid is verwijderd uit het systeem. Vergeet hem niet te verwijderen in de GA';

        $this->authentication();
        $this->get(route('members.delete', ['memberId' => $members->id]));
        $this->session($session);
        $this->dontSeeInDatabase('members', ['id' => $members->id]);
        $this->seeStatusCode(302);
    }
}
