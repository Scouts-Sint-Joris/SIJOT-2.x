<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MailingTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD: /backend/mailing
     * ROUTE:    backend.mailing.index
     *
     * @group mailing
     * @group all
     */
    public function testBackendEndIndex()
    {
        $this->authentication();
        $this->get(route('backend.mailing.index'));
        $this->seeStatusCode(200);
    }

    /**
     * DESTROY:  /backend/mailing/destroy/{id}
     * ROUTE:    backend.mailing.destroy
     *
     * @group mailing
     * @group all
     */
    public function testMailingDestroy()
    {
        $mailing = factory(App\Mailing::class)->create();
        $route   = route('backend.mailing.destroy', ['id' => $mailing->id]);

        $session['class']   = 'alert alert-success';
        $session['message'] = trans('flash-session.mailing-destroy');

        $this->authentication();
        $this->get($route);
        $this->dontSeeInDatabase('mailings', ['id' => $mailing->id]);
        $this->session($session);
        $this->seeStatusCode(302);
    }

    /**
     * GET|HEAD:  /newsletter/destroy/{id}
     * ROUTE:     backend.newsletter.destroy
     *
     * @group all
     * @group mailing
     * @group newsletter
     * @group all
     */
    public function testNewsLetterDestroy()
    {
        $newsletter = factory(App\NewsLetter::class)->create();
        $route      = route('backend.newsletter.destroy', ['string' => $newsletter->code]);

        $session['class']   = 'alert alert-success';
        $session['message'] = 'The email address has been removed.';

        $this->get($route);
        $this->dontSeeInDatabase('news_letters', ['id' => $newsletter->id]);
        $this->seeStatusCode(302);
        $this->session($session);
    }

    /**
     * POST:   /newsletter/insert
     * ROUTE:  newsletter.insert
     *
     * - With validation errors.
     *
     * @group mailing
     * @group newsletter
     * @group mailing
     * @group all
     */
    public function testNewsLetterCreateWithErrors()
    {
        $route  = route('newsletter.insert');

        $this->post($route, []);
        $this->assertSessionHasErrors();
        $this->assertHasOldInput();
        $this->seeStatusCode(302);
    }

    /**
     * POST:  /newsletter/insert
     * ROUTE: newsletter.insert
     *
     * - Without validation errors.
     *
     * @group mailing
     * @group newsletter
     * @group all
     */
    public function testNewsLetterInsertWithoutErrors()
    {
        $route  = route('newsletter.insert');

        $input['email'] = 'Jhon@example.tld';
        $input['code']  = str_limit(16);

        $session['class']   = 'alert alert-success';
        $session['message'] = trans('flash-session.newsletter-register');

        $this->post($route, $input);
        $this->session($session);
        $this->seeInDatabase('news_letters', $input);
        $this->seeStatusCode(302);
    }

    /**
     * POST:  /backend/mailing/insert
     * ROUTE: mailing.register
     *
     * - With validation errors.
     *
     * @group mailing
     * @group newsletter
     * @group all
     */
    public function testMailingInsertWithError()
    {
        $this->authentication();
        $this->post(route('mailing.register'), []);
        $this->seeStatusCode(302);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
    }

    /**
     * POST:  /backend/mailing/insert
     * ROUTE: mailing.register
     *
     * - Without validation errors.
     *
     * @group mailing
     * @group newsletter
     * @group all
     */
    public function testMailingInsertWithoutError()
    {
        $input['email'] = 'jhon@doe.tld';
        $input['name']  = 'Jhon Doe';

        $this->authentication();
        $this->post(route('mailing.register'), $input);
        $this->seeInDatabase('mailings', $input);
        $this->seeStatusCode(302);
    }

    /**
     *
     */
    public function testMailingUpdateWithoutErrors()
    {
        $this->authentication();
    }

    /**
     *
     */
    public function testMailingUpdateWithErrors()
    {
        $this->authentication();
    }
}
