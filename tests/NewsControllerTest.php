<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class NewsControllerTest
 */
class NewsControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * GET|HEAD: /backend/news
     * ROUTE:    news.backend.index
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testNewsOverview()
    {
        $this->authentication();
        $this->get(route('news.backend.index'));
        $this->seeStatusCode(200);
        $this->see('Nieuwsberichten');
    }

    /**
     * GET|HEAD: /backend/news/draft/{id}
     * ROUTE:    news.backend.draft
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testSetToDraft()
    {
        $item  = factory(App\News::class)->create(['state' => 1]);
        $route = route('news.backend.draft', ['id' => $item->id]);

        $session['class']   = 'alert alert-success';
        $session['message'] = trans('flash-session.new-draft');

        $this->authentication();
        $this->get($route);
        $this->dontSeeInDatabase('news', ['id' => $item->id, 'state' => 1]);
        $this->seeInDatabase('news', ['id' => $item->id, 'state' => 0]);
        $this->session($session);
        $this->seeStatusCode(302);
    }

    /**
     * POST:  /backend/news/insert
     * ROUTE: news.backend.insert
     *
     * - With validation errors.
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testCreateItemWithError()
    {
        $route = route('news.backend.insert');

        $this->authentication();
        $this->post($route, []);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
        $this->seeStatusCode(302);
    }

    /**
     * POST:  /backend/news/insert
     * ROUTE: news.backend.insert
     *
     * - Without validation errors.
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testCreateItemWithoutError()
    {
        $route = route('news.backend.insert');

        // Input
        $input['state']   = 0;
        $input['user_id'] = 1;
        $input['heading'] = 'Heading';
        $input['content'] = 'Content';

        // Session
        $session['class']   = 'alert alert-success';
        $session['message'] = trans('flash-session.news-update');

        $this->authentication();
        $this->post($route, $input);
        $this->session($session);
        $this->seeInDatabase('news', $input);
        $this->seeStatusCode(302);
    }

    /**
     * GET|HEAD: /backend/news/update/{id}
     * ROUTE:    news.backend.edit
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testEditView()
    {
        $news  = factory(App\News::class)->create();
        $route = route('news.backend.edit', ['id' => $news->id]);

        $this->authentication();
        $this->get($route);
        $this->seeStatusCode(200);
    }

    /**
     * PUT|PATCH: /backend/news/update/{id}
     * ROUTE:     news.backend.update
     *
     * - with validation errors.
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testUpdateMethodWithErrors()
    {
        $news  = factory(App\News::class)->create();
        $route = route('news.backend.update', ['id' => $news->id]);

        $this->authentication();
        $this->post($route, []);
        $this->assertHasOldInput();
        $this->assertSessionHasErrors();
        $this->seeStatusCode(302);
    }

    /**
     * PUT|PATCH:  /backend/news/update/{id}
     * ROUTE:      news.backend.update
     *
     * - without validation errors
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testUpdateMethodWithoutErrors()
    {
        // Routing
        $news  = factory(App\News::class)->create();
        $param = ['id' => $news->id];
        $route = route('news.backend.update', $param);

        // Session.
        $session['class']   = 'alert alert-success';
        $session['message'] = trans('flash-session.news-update');

        // Input
        $input['state']   = 0;
        $input['user_id'] = 1;
        $input['heading'] = 'Heading';
        $input['content'] = 'Content';

        $this->authentication();
        $this->dontSeeInDatabase('news', array_merge($param, $input));
        $this->post($route, $input);
        $this->seeInDatabase('news', array_merge($param, $input));
        $this->session($session);
        $this->seeStatusCode(302);
    }

    /**
     * GET|HEAD:  /backend/news/show/{id}
     * ROUTE:     news.backend.show
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testItemBackendShow()
    {
        $news  = factory(App\News::class)->create();
        $route = route('news.backend.show', ['id' => $news->id]);

        $this->authentication();
        $this->get($route);
        $this->seeStatusCode(200);
    }

    /**
     * GET|HEAD:  /backend/news/publish/{id}
     * ROUTE:     news.backend.publish
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testSetToPublish()
    {
        $item  = factory(App\News::class)->create(['state' => 0]);
        $route = route('news.backend.publish', ['id' => $item->id]);

        $session['class']   = 'alert alert-success';
        $session['message'] = trans('flash-session.news-publish');

        $this->authentication();
        $this->get($route);
        $this->dontSeeInDatabase('news', ['id' => $item->id, 'state' => 0]);
        $this->seeInDatabase('news', ['state' => 1]);
        $this->session($session);
        $this->seeStatusCode(302);
    }

    /**
     * GET|HEAD: /backend/news/destroy/{id}
     * ROUTE:    news.backend.destroy
     *
     * @group all
     * @group backend
     * @group news
     */
    public function testDeleteNewsItem()
    {
        $item  = factory(App\News::class)->create();
        $route = route('news.backend.destroy', ['id' => $item->id]);

        $session['class']   = 'alert alert-success';
        $session['message'] = trans('flash-session.news-destroy');

        $this->authentication();
        $this->get($route);
        $this->session($session);
        $this->dontSeeInDatabase('news', ['id' => $item->id]);
        $this->seeStatusCode(302);
    }
}
