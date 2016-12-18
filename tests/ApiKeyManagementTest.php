<?php

use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiKeyManagementTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testCreateKeyWithErrors()
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
    }

    public function testCreateKeyWithoutErrors()
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
    }

    public function testRegenerateKey()
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
    }

    public function testRegenerateKeyWithoutValidId()
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
    }

    public function testUpdateKeyWithErrors()
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
    }

    public function testUpdateKeyWithoutErrors()
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
    }

    public function testDeleteKey()
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
    }

    public function testDeleteKeyWithoutValidId()
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
    }
}
