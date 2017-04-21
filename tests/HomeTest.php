<?php

namespace Tests;

use Tests\TestCase;
use Chrisbjr\ApiGuard\Models\ApiKey;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @group all
     * @group front-end
     * @group home
     */
    public function testHomeFrontend()
    {
        $activity = factory(App\Activity::class)->create();

        $tags = factory(App\Tags::class, 3)->create();

        $news = factory(App\News::class, 3)
           ->create([
                'user_id' => App\User::first()
            ])
           ->each(function ($news) use ($tags) {
                $news->tags()->attach($tags);
            });

        $this->get(route('home'));
        $this->seeStatusCode(200)
            ->see($news->first()->heading);
    }

    /**
     * @group all
     * @group front-end
     * @group home
     */
    public function testHomeBackend()
    {
        $this->authentication();
        $this->get(route('home.backend'));
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD: /api
     *
     * @group all
     * @group api
     */
    public function testApiHome()
    {
        $apiKey = factory(ApiKey::class)->create();
        $headers['X-Authorization'] = $apiKey->key;

        $this->get('/api', $headers);
        $this->seeStatusCode(200);
        $this->seeJsonEquals([
            'data' => [
                'group' => config('app.name'),
                'admin' => 'Tim Joosten',
                'version' => '1.0.0',
            ]
        ]);
    }
}
