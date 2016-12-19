<?php

use Chrisbjr\ApiGuard\Models\ApiKey;
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
<<<<<<< HEAD

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
=======
>>>>>>> 59e830bade4a3c7174f22a056962749d7fe36b46
    }

    /**
     * @group all
     * @group api
     */
    public function testCreateKeyWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
<<<<<<< HEAD

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
=======
>>>>>>> 59e830bade4a3c7174f22a056962749d7fe36b46
    }

    /**
     * @group all
     * @group api
     */
    public function testRegenerateKey()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
<<<<<<< HEAD

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
=======
>>>>>>> 59e830bade4a3c7174f22a056962749d7fe36b46
    }

    /**
     * @group all
     * @group api
     */
    public function testRegenerateKeyWithoutValidId()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
<<<<<<< HEAD

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
=======
>>>>>>> 59e830bade4a3c7174f22a056962749d7fe36b46
    }

    /**
     * @group all
     * @group api
     */
    public function testUpdateKeyWithErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
<<<<<<< HEAD

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
=======
>>>>>>> 59e830bade4a3c7174f22a056962749d7fe36b46
    }

    /**
     * @group all
     * @group api
     */
    public function testUpdateKeyWithoutErrors()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
<<<<<<< HEAD

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
=======
>>>>>>> 59e830bade4a3c7174f22a056962749d7fe36b46
    }

    /**
     * @group all
     * @group api
     */
    public function testDeleteKey()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
<<<<<<< HEAD

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
=======
>>>>>>> 59e830bade4a3c7174f22a056962749d7fe36b46
    }

    /**
     * @group all
     * @group api
     */
    public function testDeleteKeyWithoutValidId()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;
<<<<<<< HEAD

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
=======
>>>>>>> 59e830bade4a3c7174f22a056962749d7fe36b46
    }
}
