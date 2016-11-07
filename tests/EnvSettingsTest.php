<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnvSettingsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testIndexPage()
    {
        $this->authentication();
        $this->visit(route('settings.env'));
        $this->seeStatusCode(200);
    }
}
