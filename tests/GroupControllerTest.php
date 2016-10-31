<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class GroupControllerTest
 */
class GroupControllerTest extends TestCase
{
    // DatabaseTransactions = Used for running the queries against the database.
    // DatabaseMigrations   = Used for migrating the database tables.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD: /groups
     * ROUTE:    frontend.groups
     *
     * @group frontend
     * @group all
     * @group groups
     */
    public function testFrontEndOverview()
    {
        $route = route('frontend.groups');

        $this->get($route);
        $this->seeStatusCode(200);

    }

    /**
     * GET|HEAD: /groups/{selector}
     * ROUTE:    frontend.groups.specific
     *
     * @group frontend
     * @group groups
     * @group all
     */
    public function testFrontEndSpecific()
    {
        $group = factory(App\Groups::class)->create();
        $route = route('frontend.groups.specific', ['selector' => $group->selector]);

        $this->get($route);
        $this->seeStatusCode(200);
    }

    /**
     * PUT|PATCH: /groups/update/{selector}
     * ROUTE:     groups.update
     *
     * - With validation errors.
     *
     * @group backend
     * @group all
     * @group groups
     */
    public function testUpdateMethodWithErrors()
    {
        $group = factory(App\Groups::class)->create();
        $param = ['selector' => $group->selector];
        $route = route('groups.update', $param);

        $this->authentication();
        $this->post($route, []);
        $this->seeStatusCode(302);
        $this->assertHasOldInput();
    }

    /**
     * PUT|PATCH: /groups/update/{selector}
     * ROUTE:     groups.update
     *
     * @group backend
     * @group all
     * @group groups
     */
    public function testUpdateMethodWithoutErrors()
    {
        $group = factory(App\Groups::class)->create();
        $param = ['selector' => $group->selector];
        $route = route('groups.update', $param);

        $session['class']   = 'alert alert-success';
        $session['message'] = trans('flash-session.group-update');

        $input['heading']     = 'Heading';
        $input['sub_heading'] = 'sub heading';
        $input['description'] = 'description';

        $this->authentication();
        $this->post($route, $input);
        $this->dontSeeInDatabase('groups', ['heading' => $group->heading, 'sub_heading' => $group->sub_heading, 'description' => $group->description]);
        $this->seeInDatabase('groups', $input);
        $this->session($session);
        $this->seeStatusCode(200);
    }

    /**
     * PUT|PATCH: /groups/edit
     * ROUTE:     groups.edit
     *
     * @group backend
     * @group all
     * @group groups
     */
    public function testUpdateView()
    {
        $route = route('groups.edit');

        $this->authentication();
        $this->get($route);
        $this->seeStatusCode(200);
    }
}