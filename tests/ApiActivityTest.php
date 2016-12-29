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
        $this->dontSeeInDatabase('activities', ['id' => $activity->id]);
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

        // output
        $output['message']    = 'De activiteit is aangemaakt.';
        $output['http_code']  = 201;

        $this->post(route('api.activity.create'), $input, $headers);
        $this->seeInDatabase('activities', ['heading' => $input['heading']]);
        $this->seeStatusCode(200);
        $this->seeJson($output);
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
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->post(route('api.activity.create'), [], $headers);
        $this->seeStatusCode(200);
        $this->seeJson(['message' => 'Kan de activiteit niet aanmaken.', 'http_code' => 400]);
    }

    /**
     * GET|HEAD:    /api/activity/{activityId}
     * ROUTE:       activity.show
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testActivityShowValid()
    {
        $apiKey   = factory(ApiKey::class)->create();
        $activity = factory(App\Activity::class)->create();

        $headers['X-Authorization'] = $apiKey->key;

        $this->get(route('api.activity.show', ['activityId' => $activity->id]), $headers);
        $this->seeStatusCode(200);
        $this->isJson();
    }

    /**
     * GET|HEAD:    /api/activity/{activityId}
     * ROUTE:       api.activity.show
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testActivityShowInvalid()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->get(route('api.activity.show', ['activityId' => 10000]), $headers);
        $this->seeStatusCode(404);
        $this->seeJson(["error" => ["code" => "GEN-NOT-FOUND", "http_code" => 404, "message" => "Resource Not Found"]]);
    }

    /**
     * PUT:   /api/activity/{acitivityId}
     * ROUTE: api.activity.edit
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testPutActivityUpdateInvalid()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->delete(route('api.activity.edit', ['activityId' => 1000000]), $headers);
        $this->seeStatusCode(404);
        $this->seeJson(["error" => ["code" => "GEN-NOT-FOUND", "http_code" => 404, "message" => "Resource Not Found"]]);
    }

    /**
     * PUT:   /api/activity/{acitivityId}
     * ROUTE: api.activity.edit
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testPutActivityUpdateValid()
    {

    }

    /**
     * PUT:   /api/activity/{acitivityId}
     * ROUTE: api.activity.edit
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testPutActivityValidationErrors()
    {
        $apiKey   = factory(ApiKey::class)->create();
        $activity = factory(App\Activity::class)->create();

        $headers['X-Authorization'] = $apiKey->key;

        $this->put(route('api.activity.edit', ['activityId' => $activity->id]), [], $headers);
        $this->seeStatusCode(200);
        $this->seeJsonContains(['message' => 'Wij konden de activiteit niet aanpassen.', 'http_code' => 400]);
    }

    /**
     * PATCH:   /api/activity/{acitivityId}
     * ROUTE: api.activity.edit
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testPatchActivityValidationErrors()
    {
        $apiKey   = factory(ApiKey::class)->create();
        $activity = factory(App\Activity::class)->create();

        $headers['X-Authorization'] = $apiKey->key;

        $this->patch(route('api.activity.edit', ['activityId' => $activity->id]), [], $headers);
        $this->seeStatusCode(200);
        $this->seeJsonContains(['message' => 'Wij konden de activiteit niet aanpassen.', 'http_code' => 400]);
    }

    /**
     * PATCH: /api/activity/{acitivityId}
     * ROUTE: api.activity.edit
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testPatchActivityInvalid()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->delete(route('api.activity.edit', ['activityId' => 1000000]), $headers);
        $this->seeStatusCode(404);
        $this->seeJson(["error" => ["code" => "GEN-NOT-FOUND", "http_code" => 404, "message" => "Resource Not Found"]]);
    }

    /**
     * PATCH: /api/activity/{acitivityId}
     * ROUTE: api.activity.edit
     *
     * @group api
     * @group all
     * @group activity
     */
    public function testPatchActivityValid()
    {

    }
}
