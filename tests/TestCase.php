<?php

use Illuminate\Support\Facades\Hash;

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
    protected $baseUrl = 'http://localhost:8000';

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

        Hash::setRounds(5);

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

    /**
     * The setup for the rental stuff.
     */
    protected function rentalSetup()
    {
        factory(App\Rental::class)->create([
            'status_id' => function () {
                return factory(App\RentalStatus::class)->create([
                    'name'  => 'Optie', 
                    'class' => 'label label-warning',
                ])->id;
            }
        ]);

        factory(App\Rental::class)->create([
            'status_id' => function () {
                return factory(App\RentalStatus::class)->create([
                    'name'  => 'Bevestigd',
                    'class' => 'label label-success',
                ])->id;
            }
        ]);

        factory(App\Rental::class)->create([
            'status_id' => function () {
                return factory(App\RentalStatus::class)->create([
                    'name'  => 'Nieuwe aanvraag', 
                    'class' => 'label label-danger',
                ])->id;
            }
        ]);
    }
}
