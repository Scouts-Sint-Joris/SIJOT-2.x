<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ActivityControllerTest
 */
class ActivityControllerTest extends TestCase
{
    // DatabaseMigrations   = Trait for running the db migrations each test.
    // DatabaseTransactions = Trait for running qeuries against the db stub.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD: /backend/activity
     * ROUTE:    activity.index
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testOverview()
    {
        $this->authentication();
        $this->visit(route('activity.index'));
        $this->seeStatusCode(200);
    }

    /**
     * POST:    /backend/activity
     * ROUTE:   activity.store
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testInsertWithOutError()
    {
        // Route 
        $route = route('activity.store'); 

        // Input 

        // Session 

        // Testing logic.
        $this->authentication();
        $this->post($route, $input);
        $this->seeStatusCode(302);  
    }

    /**
     * POST:    /backend/activity
     * ROUTE:   activity.store
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testInsertWithError()
    {
        $this->authentication();
        $this->post(route('activity.store'), []);
        $this->seeStatusCode(302);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
    }

    /**
     * PUT|PATCH: /backend/activity/update/{id}
     * ROUTE:     activity.update
     *
     * - Update method with validation errors.
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testUpdateError()
    {
        $activity = factory(App\Activity::class)->create();

        $this->authentication();
        $this->post(route('activity.update', ['id' => $activity->id]));
        $this->seeStatusCode(302);
        $this->assertSessionHasErrors();
        $this->assertHasOldInput();
    }

    /**
     * @group all
     * @group activity
     * @group back-end
     */
    public function testUpdateWithOutError()
    {

    }

    /**
     * GET|HEAD:  /backend/activity/destroy/{id}
     * ROUTE:     activity.destroy
     *
     * @group all
     * @group activity
     * @group back-end
     */
    public function testDestroyActivity()
    {
        $activity = factory(App\Activity::class)->create();
        $group    = factory(App\Groups::class)->create();
        $data     = ['id' => $activity->id];
        $route    = route('activity.destroy', $data);

        $session['class'] = 'alert alert-success';
        $session['message'] = '';

        $this->authentication();
        $this->seeInDatabase('activities', $data);
        $this->get($route);
        $this->dontSeeInDatabase('activities', $data);
        $this->seeStatusCode(302);
        $this->session($session);
    }
}
