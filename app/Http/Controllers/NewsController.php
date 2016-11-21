<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsFormRequest;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsPublish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    const PER_PAGE = 20;

    protected $news;
    protected $news_category;

    public function __construct(News $news, NewsCategory $news_category)
    {
        $this->news = $news;
        $this->news_category = $news_category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view_data_arr['news_collection'] = $this->news->paginate(self::PER_PAGE);
        return view('news.index', $view_data_arr);
    }

    public function search(Request $request)
    {
        $search_str = $request->input('search_str');
        $view_data_arr['news_collection'] = $this->news->paginateByTitleOrContent($search_str, self::PER_PAGE);
        return view('news.index', $view_data_arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $view_data_arr['categories'] = $this->news_category->lists('name', 'id');
        return view('news.create', $view_data_arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(NewsFormRequest $request)
    {
        $data = $request->except('show_time');
        $show_time = $request->input('show_time');

        $data['og_image'] = $this->getOgImageFromContent($request->input('content'));

        if (($data['status'] == 2)&&(empty($show_time))) {
            return redirect()->back()->withErrors('請填發佈時間');
        }

        if ($data['status'] == 2) {
            DB::transaction(function () use ($data, $show_time) {
                $news = $this->news->create($data);
                NewsPublish::create(['news_id' => $news->id, 'show_time' => $show_time]);
            });
        } else {
            $this->news->create($data);
        }

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $view_data_arr['news'] = $this->news->find($id);
        $view_data_arr['isMobile'] = 0;
        return view('news.show', $view_data_arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $view_data_arr['news'] = $this->news->find($id);
        $view_data_arr['categories'] = $this->news_category->lists('name', 'id');
        return view('news.edit', $view_data_arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(NewsFormRequest $request, $id)
    {
        $data['title'] = $request->input('title');
        $data['content'] = $request->input('content');
        $data['news_category_id'] = $request->input('news_category_id');
        $data['status'] = $request->input('status');
        $data['og_image'] = $this->getOgImageFromContent($request->input('content'));

        $show_time = $request->input('show_time');

        if (($data['status'] == 2)&&(empty($show_time))) {
            return redirect()->back()->withErrors('請填發佈時間');
        }

        if ($data['status'] == 2) {
            DB::transaction(function () use ($data, $show_time, $id) {
                $this->news->find($id)->update($data);
                NewsPublish::updateOrCreate(
                    ['news_id' => $id],
                    ['show_time' => $show_time]
                );
            });
        } else {
            $this->news->find($id)->update($data);
        }

        return redirect()->route('news.index');
    }

    private function getOgImageFromContent($content)
    {
        preg_match("/<img alt=\"\" src=\"(.*?)\" /", $content, $og_image);
        $first_og_image = count($og_image) >= 2 ? $og_image[1] : '';
        return $first_og_image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->news->destroy($id);
        return redirect()->route('news.index');
    }

    public function updateTopStatus(Request $request, $id)
    {
        $top_status = $request->input('top_status');
        $this->news->find($id)->update(['top_status' => $top_status]);
        return redirect()->route('news.index');
    }

}
