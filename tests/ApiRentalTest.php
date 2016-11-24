<?php

use Chrisbjr\ApiGuard\Models\ApiKey;
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
     * GET|HEAD: /api/rental/{id}
     *
     * @group api
     * @group all
     */
    public function testRentalShow()
    {
        $apiKey = factory(ApiKey::class)->create();
        $lease  = factory(App\Rental::class)->create(['id' => 3]);
        $headers['X-Authorization'] = $apiKey->key;

        // Unauthencated
        $noAuth = $this->get('api/rental/0');
        $noAuth->seeStatusCode(401);
        $noAuth->seeJson([
            "error" => [
                "code" => "GEN-UNAUTHORIZED",
                "http_code" => 401,
                "message" => "Unauthorized"
            ]
        ]);

        // No record found
        $noRec = $this->get('/api/rental/1000000000', $headers);
        $noRec->seeStatusCode(404);
        $noRec->seeJson([
            "error" => [
                "code" => "GEN-NOT-FOUND",
                "http_code" => 404,
                "message" => "Resource Not Found",
            ]
        ]);

        // Record found.
        $rec = $this->get('/api/rental/3', $headers);
        $rec->seeStatusCode(200);
    }

    /**
     * POST: /api/rental
     *
     * @group api
     * @group all
     */
    public function testRentalInsert()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        // Unauthencated.
        $noAuth = $this->post('api/rental', []);
        $noAuth->seeStatusCode(401);
        $noAuth->seeJson([
            "error" => [
                "code" => "GEN-UNAUTHORIZED",
                "http_code" => 401,
                "message" => "Unauthorized"
            ]
        ]);

        // Validation errors.
        $err = $this->post('/api/rental', [], $headers);
        $err->seeStatusCode(200);
        $err->seeJson([
            'message' => 'Could not process the insert.',
            'http_code' => 400,
            'errors' => [
                'start_date' => ['The start date field is required.'],
                'end_date' => ['The end date field is required.',],
                'group' => ['The group field is required.',],
                'email' => ['The email field is required.',],
            ],
        ]);

        // No validation errors.
        $input['start_date']   = '10/10/1995';
        $input['end_date']     = '11/10/1995';
        $input['group']        = 'Sint-Joris, Turnhout';
        $input['email']        = 'contact@st-joris-turnhout.be';
        $input['phone_number'] = '0000/00.00.00';

        $req = $this->post('/api/rental', $input, $headers);
        $req->seeStatusCode(200);
        $req->seeJson(['message' => 'De verhuring is aangemaakt.', 'http_code' => 201]);
        $req->seeIndatabase('rentals', [
            'email' => $input['email'],
            'group' => $input['group'],
            'phone_number' => $input['phone_number'],
            'end_date' => strtotime(str_replace('/', '-', $input['end_date'])),
            'start_date' => strtotime(str_replace('/', '-', $input['start_date']))
        ]);
    }

    /**
     * PUT:  /api/rental/{id}
     *
     * @group api
     * @group all
     */
    public function testRentalUpdatePut()
    {
        // Database factories
        $apiKey = factory(ApiKey::class)->create();
        $lease  = factory(App\Rental::class)->create(['id' => 40]);

        // API Headers (HTTP)
        $headers['X-Authorization'] = $apiKey->key;

        // User simulated inputs.
        $input['start_date']   = '10/10/1995';
        $input['end_date']     = '11/10/1995';
        $input['group']        = 'Sint-Joris, Turnhout';
        $input['email']        = 'contact@st-joris-turnhout.be';
        $input['phone_number'] = '0000/00.00.00';

        // Unauthenticated
        $noAuth = $this->put('/api/rental/' . $lease->id, []);
        $noAuth->seeStatusCode(401);
        $noAuth->seeJson([
            "error" => [
                "code" => "GEN-UNAUTHORIZED",
                "http_code" => 401,
                "message" => "Unauthorized"
            ]
        ]);

        // No record found.
        $noRec = $this->put('/api/rental/41', $input, $headers);
        $noRec->seeStatusCode(404);
        $noRec->seeJson([
            "error" => [
                "code" => "GEN-NOT-FOUND",
                "http_code" => 404,
                "message" => "Resource Not Found",
            ]
        ]);

        // Validation fails.
        $err = $this->put('/api/rental/' . $lease->id, [], $headers);
        $err->seeStatusCode(400);
        $err->seeJson([
            'message' => 'Could not update the lease information',
            'http_code' => 400,
            'errors' => [
                'start_date' => ['The start date field is required.'],
                'end_date' => ['The end date field is required.',],
                'group' => ['The group field is required.',],
                'email' => ['The email field is required.',],
            ],
        ]);

        // Validation passes
        $data = $this->put('/api/rental/' . $lease->id, $input, $headers);
        $data->seeStatusCode(200);
        $data->seeJson(['message' => 'De verhuring is gewijzigd.', 'http_code' => 200]);
        $data->seeIndatabase('rentals', [
            'email' => $input['email'],
            'group' => $input['group'],
            'phone_number' => $input['phone_number'],
            'end_date' => strtotime(str_replace('/', '-', $input['end_date'])),
            'start_date' => strtotime(str_replace('/', '-', $input['start_date']))
        ]);
    }

    /**
     * PATCH:  /api/rental/{id}
     *
     * @group api
     * @group all
     */
    public function testRentalUpdatePatch()
    {
        // Database factories
        $apiKey = factory(ApiKey::class)->create();
        $lease  = factory(App\Rental::class)->create(['id' => 40]);

        // API Headers (HTTP)
        $headers['X-Authorization'] = $apiKey->key;

        // User simulated inputs.
        $input['start_date']   = '10/10/1995';
        $input['end_date']     = '11/10/1995';
        $input['group']        = 'Sint-Joris, Turnhout';
        $input['email']        = 'contact@st-joris-turnhout.be';
        $input['phone_number'] = '0000/00.00.00';

        // Unauthenticated
        $noAuth = $this->patch('/api/rental/' . $lease->id, []);
        $noAuth->seeStatusCode(401);
        $noAuth->seeJson([
            "error" => [
                "code" => "GEN-UNAUTHORIZED",
                "http_code" => 401,
                "message" => "Unauthorized"
            ]
        ]);

        // No record found.
        $noRec = $this->patch('/api/rental/41', $input, $headers);
        $noRec->seeStatusCode(404);
        $noRec->seeJson([
            "error" => [
                "code" => "GEN-NOT-FOUND",
                "http_code" => 404,
                "message" => "Resource Not Found",
            ]
        ]);

        // Validation fails.
        $err = $this->patch('/api/rental/' . $lease->id, [], $headers);
        $err->seeStatusCode(400);
        $err->seeJson([
            'message' => 'Could not update the lease information',
            'http_code' => 400,
            'errors' => [
                'start_date' => ['The start date field is required.'],
                'end_date' => ['The end date field is required.',],
                'group' => ['The group field is required.',],
                'email' => ['The email field is required.',],
            ],
        ]);

        // Validation passes
        $data = $this->patch('/api/rental/' . $lease->id, $input, $headers);
        $data->seeStatusCode(200);
        $data->seeJson(['message' => 'De verhuring is gewijzigd.', 'http_code' => 200]);
        $data->seeIndatabase('rentals', [
            'email' => $input['email'],
            'group' => $input['group'],
            'phone_number' => $input['phone_number'],
            'end_date' => strtotime(str_replace('/', '-', $input['end_date'])),
            'start_date' => strtotime(str_replace('/', '-', $input['start_date']))
        ]);
    }

    /**
     * DELETE:  /api/rental/{id}
     *
     * @group api
     * @group all
     */
    public function testRentalDelete()
    {
        $idArray = ['id' => 2];
        $apiKey  = factory(ApiKey::class)->create();
        $lease   = factory(App\Rental::class)->create($idArray);

        $headers['X-Authorization'] = $apiKey->key;

        // Unauthencated
        $noAuth = $this->delete('api/rental/0');
        $noAuth->seeStatusCode(401);
        $noAuth->seeJson([
            "error" => [
                "code" => "GEN-UNAUTHORIZED",
                "http_code" => 401,
                "message" => "Unauthorized"
            ]
        ]);

        // No record found.
        $noRec = $this->delete('/api/rental/1000000000', $headers);
        $noRec->seeStatusCode(404);
        $noRec->seeJson([
            "error" => [
                "code" => "GEN-NOT-FOUND",
                "http_code" => 404,
                "message" => "Resource Not Found",
            ]
        ]);

        // Record found.
        $rec = $this->delete('/api/rental/' . $lease->id, $headers);
        $rec->dontSeeInDatabase('rentals', $idArray);
        $rec->seeStatusCode(200);
        $rec->seeJson();
    }
}
