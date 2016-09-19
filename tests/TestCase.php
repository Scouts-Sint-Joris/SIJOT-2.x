<?php

/**
 * Class TestCase
 */
abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /** @var $user the user factory */
    protected $user;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Testing facility constructor.
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create();
    }

    /**
     * [STUB]: Authencation users.
     *
     * Authenticate the user through the testing facilities.
     * USAGE: $this->authencation();
     */
    protected function authentication()
    {
        $this->actingAs($this->user);
        $this->seeIsAuthenticatedAs($this->user);
    }
}
