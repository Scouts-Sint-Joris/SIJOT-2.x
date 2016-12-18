<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiKeyManagementTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group all
     * @group api
     */
    public function testCreateKeyWithErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group api
     */
    public function testCreateKeyWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group api
     */
    public function testRegenerateKey()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group api
     */
    public function testRegenerateKeyWithoutValidId()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group api
     */
    public function testUpdateKeyWithErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group api
     */
    public function testUpdateKeyWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group api
     */
    public function testDeleteKey()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }

    /**
     * @group all
     * @group api
     */
    public function testDeleteKeyWithoutValidId()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
    }
}
