<?php

use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ApiKeyManagementTest
 */
class ApiKeyManagementTest extends TestCase
{
    // DatabaseMigrations   = Used to run the database migrations.
    // DatabaseTransactions = Used to run the queries against the database.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD: /api/authorizations
     *
     * @group all
     * @group api
     */
    public function testIndexOverviewWithoutPagination()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->get('/api/authorizations', $headers);
        $this->seeStatusCode(200);
        $this->seeJson(['cursor' => ['current' => false, 'prev' => 6, 'next' => 1, 'count' => 1]]);
    }

    /**
     * GET|HEAD: /api/authorizations
     *
     * @group all
     * @group api
     */
    public function testIndexOverviewWithPagination()
    {
        $apiKey = factory(ApiKey::class, 12)->create();
        $headers['X-Authorization'] = $apiKey[0]->key;

        $page1 = $this->get('/api/authorizations', $headers);
        $page1->seeStatusCode(200);
        $page1->seeJson(['cursor' => ['current' => false, 'prev' => 6, 'next' => 5, 'count' => 5]]);
    }

    /**
     * ROUTE: /api/authorizations.
     *
     * @group all
     * @group api
     */
    public function testIndexOverviewWithoutData()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->get('/api/authorizations', $headers);
        $this->seeStatusCode(200);
        $this->seeJson(['cursor' => ['current' => false, 'prev' => 6, 'next' => 1, 'count' => 1]]);
    }

    /**
     * GET|HEAD: /api/authorizations/regenerate/{id}
     *
     * @group all
     * @group api
     */
    public function testRegenerateKeyValid()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->get('/api/authorizations/regenerate/' . $apiKey->id, $headers);
        $this->seeStatusCode(200);
        $this->dontSeeInDatabase('api_keys', ['key' => $apiKey->key]);
        $this->seeJson(['message' => 'De API sleutel is aangepast']);
    }

    /**
     * GET|HEAD: /api/authorizations/regenerate/{id}
     *
     * @group all
     * @group api
     */
    public function testRegenerateKeyInValid()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->get('/api/authorizations/regenerate/1000', $headers);
        $this->seeStatusCode(404);
        $this->seeJson(['message' => 'Er is geen key met deze id gevonden.']);
    }

    /**
     * POST: /api/authorizations/new
     *
     * - No validation errors.
     *
     * @group all
     * @group api
     */
    public function testCreateNewKeyWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        // Input
        $input['user_id'] = factory(App\User::class)->create()->id;
        $input['service'] = 'Application';

        // Route testing
        $this->post('/api/authorizations/new', $input, $headers);
        $this->seeStatusCode(200);
        $this->seeInDatabase('api_keys', ['service' => $input['service']]);
        $this->seeJson([
            'message'   => 'De API sleutel is toegevoegd',
            'http_code' => 200
        ]);

    }

    /**
     * POST: /api/authorizations/new
     *
     *  - With validation errors
     *
     * @group all
     * @group api
     */
    public function testCreateNewKeyWithErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->post('/api/authorizations/new', [], $headers);
        $this->seeStatusCode(400);
        $this->seeJson([
            'message'   => 'De API Sleutel kon niet aangemaakt worden.',
            'http_code' => 400,
            'errors'    => [
                'user_id'  => [0 => 'The user id field is required.'],
                'service'  => [0 => 'The service field is required.'],
            ],
        ]);
    }

    /**
     * DELETE: /api/authorizations/delete/{id}
     *
     * @group all
     * @group api
     */
    public function testDeleteValidId()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->delete('/api/authorizations/delete/' . $apiKey->id, $headers);
        $this->dontSeeInDatabase('api_keys', ['id' => $apiKey->id, 'deleted_at' => '']);
        $this->seeJson(['message' => 'De API Sleutel is verwijderd']);
        $this->seeStatusCode(200);
    }

    /**
     * DELETE: /api/authorizations/delete/{id}
     *
     * @group all
     * @group api
     */
    public function testDeleteInValidId()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->delete('/api/authorizations/delete/000000', $headers);
        $this->seeJson(['message' => 'Er is geen API sleuter gevonden met deze id.']);
        $this->seeStatusCode(404);
    }

}
