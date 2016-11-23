<?php

use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ApiRentalTest
 */
class ApiRentalTest extends TestCase
{
    // DatabaseMigrations   = Used to run the database migrations.
    // DatabaseTransactions = Used to run the database transactions.
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * ROUTE: api/rental
     *
     * @group api
     * @group all
     */
    public function testRentalIndex()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        // Test unauthencated.
        $noAuth = $this->get('api/rental');
        $noAuth->seeStatusCode(401);
        $noAuth->seeJson([
            "error" => [
                "code" => "GEN-UNAUTHORIZED",
                "http_code" => 401,
                "message" => "Unauthorized"
            ]
        ]);

        // See No data with authencation.
        $noData = $this->get('api/rental', $headers);
        $noData->seeStatusCode(200);
        $noData->seeJson(['message' => 'Er zijn geen verhuringen']);

        // With data
        $rental = factory(App\Rental::class)->create();

        $withData = $this->get('api/rental', $headers);
        $withData->seeStatusCode(200);
        $withData->isJson();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalInsertErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalInsertWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalUpdateWithErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalUpdateWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalDeleteValidId()
    {
        $apiKey = factory(ApiKey::class)->create();
    }

    /**
     * @group api
     * @group all
     */
    public function testRentalDeleteInvalidId()
    {
        $apiKey = factory(ApiKey::class)->create();
    }
}
