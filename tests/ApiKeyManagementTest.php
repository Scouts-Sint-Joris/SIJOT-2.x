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
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group all
     * @group api
     */
    public function testIndexOverviewWithoutPagination()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    public function testIndexOverviewWithPagination()
    {

    }

    public function testIndexOverviewWithoutData()
    {

    }
}
