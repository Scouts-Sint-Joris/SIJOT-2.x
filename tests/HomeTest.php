<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions; 

    /**
     * @group all 
     * @group front-end 
     * @group home
     */
    public function testHomeFrontend()
    {
        $activity = factory(App\Activity::class)->create(); 

        $this->get(route('home')); 
        $this->seeStatusCode(200);
    }

    /**
     * @group all 
     * @group front-end
     * @group home 
     */
    public function testHomeBackend() 
    {
        $this->authentication(); 
        $this->get(route('home.backend')); 
        $this->seeStatusCode(200);
    }
}
