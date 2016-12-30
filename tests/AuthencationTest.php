<?php

namespace Tests;

use Tests/TestCase;
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
        $key   = factory(Chrisbjr\ApiGuard\Models\ApiKey::class)->create();
        $route = route('key.regenerate', ['id' => $key->id]);

        $session['class']   = 'alert alert-success';
        $session['message'] = 'The api key has been generated.';

        $this->authentication();
        $this->get($route);
        $this->dontSeeInDatabase('api_keys', ['key' => $key->key]);
        $this->session($session);
        $this->seeStatusCode(302);
    }

    /**
     * POST:  /settings/api/key
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
     * POST:  /settings/api/key
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
        $route = route('settings.profile.key');

        $this->authentication();
        $this->post($route, []);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
        $this->seeStatusCode(302);

    }

    /**
     * GET|HEAD: /settings/key/destroy/{id}
     * ROUTE:    key.destroy
     *
     * @group auth
     * @group all
     * @group api
     */
    public function testDeleteKey()
    {
        $key   = factory(Chrisbjr\ApiGuard\Models\ApiKey::class)->create([
            'id' => '1',
            'service' => 'application service'
        ]);

        $route = route('key.destroy', ['id' => $key->id]);

        $session['class']   = 'alert alert-success';
        $session['message'] = 'The api key has been deleted';

        $this->authentication();
        $this->get($route);
        $this->session($session);
        // $this->dontSeeInDatabase('api_keys', ['service' => $key->service]);
        $this->seeStatusCode(302);
    }
}
