<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingsControllerTest extends TestCase
{
    // DatabaseMigrations   = Running migrations agianst the database stub.
    // DatabaseTransactions = Running queries against the database stub.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD:  /settings
     * ROUTE:     settings.index
     *
     * @group all
     * @group backend
     * @group settings
     */
    public function testSettingsOverView()
    {
        $this->authentication();
        $this->visit(route('settings.index'));
        $this->seeStatusCode(200);
        $this->see('Login beheer');
    }

    /**
     * GET|HEAD:  /settings
     * ROUTE:     settings.index
     *
     * @group all
     * @group backend
     * @group settings
     */
    public function testSettingsProfile()
    {
        $this->authentication();
        $this->visit(route('settings.profile'));
        $this->seeStatusCode(200);
    }

    public function testSettingsPlatform()
    {
        //
    }

    public function testSettingsMySqlBackup()
    {
        //
    }
}
