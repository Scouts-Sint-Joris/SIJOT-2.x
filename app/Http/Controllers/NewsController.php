<?php

namespace App\Http\Controllers;

use App\News;
use App\Tags;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class NewsController
 *
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class NewsController extends Controller
{
    /** @var Collection $tagsDb The tags database model. */
    private $tagsDb;

    /** @var Collection $newsDb The news database model. */
    private $newsDb;

    /**
     * NewsController constructor.
     */
    public function __construct(Tags $tagsDb, News $newsDb)
    {
        $this->middleware('auth');
        $this->middleware('lang');

        // Param init.
        $this->tagsDb = $tagsDb;
        $this->newsDb = $newsDb;
    }

    /**
     * [BACKEND]: Get the backend overview page.
     *
     * @url:platform  GET|HEAD: /backend/news
     * @see:phpunit   NewsControllerTest::testNewsOverview()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Item states:
        // -----
        // 1 = publish
        // 0 = draft.

        $data['draft']   = $this->newsDb->where('state', 0)->get();
        $data['publish'] = $this->newsDb->where('state', 1)->get();
        $data['tags']    = $this->tagsDb->all();

        return view('news.index', $data);
    }

    /**
     * [METHOD]: Store the news message in the database.
     *
     * @url:platform  POST::
     * @see:phpunit   NewsControllerTest::testCreateItemWithError()
     * @see:phpunit   NewsControllerTest::testCreateItemWithoutError()
     *
     * @param  Requests\NewsValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\NewsValidator $input)
    {
        if ($this->newsDb->create($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.news-create'));
        }

        return redirect()->back();
    }

    /**
     * [BACKEND]: Show a specific news item.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   NewsControllerTest::testItemBackendShow()
     *
     * @param  int $id the news item id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function backendShow($id)
    {
        $data['item'] = $this->newsDb->find($id);
        return view('news.show', $data);
    }

    /**
     * [BACKEND]: Edit view for a news message.
     *
     * @url:platform  GET|HEAD: /backend/news/update/{id}
     * @see:phpunit   NewsControllerTest::testEditView()
     *
     * @param  String $id The news id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data['item'] = $this->newsDb->find($id);
        return view('news.edit', $data);
    }

    /**
     * [METHOD]: Update a news message in the database.
     *
     * @url:platform  POST: /backend/news/update/{id}
     * @see:phpunit   NewsControllerTest::testUpdateMethodWithoutErrors()
     * @see:phpunit   NewsControllerTest::testUpdateMethodWithErrors()
     *
     * @param  Requests\NewsValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\NewsValidator $input, $id)
    {
        if ($this->newsDb->findOrFail($id)->update($input->except('_token'))) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.news-update'));
        }

        return redirect()->back(302);
    }

    /**
     * [METHOD]: Set a news message to draft.
     *
     * @url:platform  GET|HEAD: /backend/news/draft/{id}
     * @see:phpunit   NewsControllerTest::testSetToDraft()
     *
     * @param  string $id the news item id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function draft($id)
    {
        if ($this->newsDb->findOrFail($id)->update(['state' => 0])) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.new-draft'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Publish a news message form the draft status.
     *
     * @see:platform  GET|HEAD: /backend/news/publish/{id}
     * @see:phpunit   NewsControllerTest::testSetToPublish()
     *
     * @param  integer  $id the news item id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish($id)
    {
        if ($this->newsDb->find($id)->update(['state' => 1])) {
            session()->flash('class', 'alert alert-danger');
            session()->flash('message', trans('flash-session.news-publish'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Delete a news post.
     *
     * @url:platform  GET|HEAD: /backend/news/destroy/{id}
     * @see:phpunit   NewsControllerTest::testDeleteNewsItem()
     *
     * @param  int $id The news post id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $destroy = $this->newsDb->findOrFail($id);
        $destroy->tags()->sync([]);
        $destroy->delete();

        if ($destroy) {
            session()->flash('class', 'alert alert-danger');
            session()->flash('message', trans('flash-session.news-destroy'));
        }

        return redirect()->back();
    }
}
