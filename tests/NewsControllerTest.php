<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewsControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewsOverview()
    {
        $this->authentication(); 
        $this->get(route('news.backend.index')); 
        $this->seeStatusCode(200);
        $this->see('Nieuwsberichten');
    }
}
