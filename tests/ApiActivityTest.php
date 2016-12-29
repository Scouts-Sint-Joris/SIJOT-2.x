<?php

use Carbon\Carbon;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiActivityTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * DELETE: /api/activity/{activityId}
     * ROUTE:  api.activity.destroy
     *
     * @group api
     * @group all
     * @group activity
     *
     */
    public function testActivityDestroyValidId()
    {
        $apiKey     = factory(ApiKey::class)->create();
        $activity   = factory(App\Activity::class)->create();

        $headers['X-Authorization'] = $apiKey->key;

        $this->delete(route('api.activity.delete', ['activityId' => $activity->id]), $headers);
        $this->seeStatusCode(200);
        $this->seeJson(['message' => 'De activiteit is verwijderd']);
    }

    /**
     * DELETE: /api/activity/{activityId}
     * ROUTE:  api.activity.destroy
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testActivityDestroyInvalidId()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->delete(route('api.activity.delete', ['activityId' => 1000000]), $headers);
        $this->seeStatusCode(404);
        $this->seeJson(["error" => ["code" => "GEN-NOT-FOUND", "http_code" => 404, "message" => "Resource Not Found"]]);
    }

    /**
     * POST:    /api/activity
     * ROUTE:   api.activity.create
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testActivityCreateWithSuccess()
    {
        // Required includes
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        // Inputs
        $input['state']       = 1;
        $input['group']       = 'De Welpen';
        $input['date']        = Carbon::now();
        $input['start_time']  = Carbon::now();
        $input['end_date']    = Carbon::now();
        $input['description'] = 'Description';
        $input['heading']     = 'Heading';
    }

    /**
     * POST:    /api/activity
     * ROUTE:   api.activity.create
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testActivityCreateNotOk()
    {

    }
}
