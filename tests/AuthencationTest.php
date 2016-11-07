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
     * @group api
     */
    public function testRegenerateKey()
    {

    }

    /**
     * @group auth
     * @group all
     * @group api
     */
    public function testCreateKey()
    {

    }

    /**
     * @group auth
     * @group all
     * @group api
     */
    public function testDeleteKey()
    {

    }
}
