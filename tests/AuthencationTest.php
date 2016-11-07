<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class AuthencationTest
 */
class AuthencationTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group auth
     * @group all
     * @group web
     */
    public function testLogoutFunction()
    {
        $form = $this->visit('/')->getForm();

        $this->visit('/')
            ->makeRequestUsingForm($form)
            ->see('Login');
    }

    /**
     * @group auth
     * @group all
     * @group web
     */
    public function tesztLoginUrl()
    {
        $route = url('/login');

        $this->get($route);
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD:
     * ROUTE: 
     * 
     * @group auth
     * @group all
     * @group api
     */
    public function testRegenerateKey()
    {
        //$route = route(); 
        $key   = factory(Chrisbjr\ApiGuard\Models\ApiKey::class)->create();

        $this->authentication();
        //$this->seeStatusCode(302);
    }

    /**
     * POST: 
     * ROUTE: settings.profile.key
     *
     * - Without validation errors.
     *
     * @group auth
     * @group all
     * @group api
     */
    public function testCreateKeyWithoutErrors()
    {
        $route = route('settings.profile.key');

        $session['class']   = 'alert alert-success';
        $session['message'] = 'The api token has been created';

        $input['userid']   = $this->user->id;
        $input['service']  = 'Test application';

        $this->authentication();
        $this->post($route, $input);
        $this->seeInDatabase('api_keys', ['user_id' => $input['userid'], 'service' => $input['service']]);
        $this->session($session);
        $this->seeStatusCode(302);
    }

    /**
     * POST:
     * ROUTE: settings.profile.key
     *
     * - With validation errors.
     *
     * @group auth
     * @group all
     * @group api
     */
    public function testCreateKeyWithErrors()
    {

    }

    /**
     * GET|HEAD:
     * ROUTE: 
     *
     * @group auth
     * @group all
     * @group api
     */
    public function testDeleteKey()
    { 
        $key   = factory(Chrisbjr\ApiGuard\Models\ApiKey::class)->create();

        $this->authentication(); 
    }
}
