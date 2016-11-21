<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\BannerFormRequest;

class BannerController extends Controller
{

    const PER_PAGE = 20;

    protected $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view_data_arr['banners'] = $this->convert($this->banner->paginate(self::PER_PAGE));
        return view('banner.index', $view_data_arr);
    }

    public function search(Request $request)
    {
        $search_str = $request->input('search_str');
        $view_data_arr['banners'] = $this->convert($this->banner->paginateByTitle($search_str, self::PER_PAGE));
        return view('banner.index', $view_data_arr);
    }

    private function convert($banners)
    {
        foreach($banners as $banner) {
            $banner->status = $banner->status === 1 ? '顯示' : '隱藏';
        }
        return $banners;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BannerFormRequest $request)
    {
        $this->banner->create($request->all());
        return redirect()->route('banner.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $view_data_arr['banner'] = $this->banner->find($id);
        return view('banner.edit', $view_data_arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(BannerFormRequest $request, $id)
    {
        $this->banner->find($id)->update($request->all());
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->banner->destroy($id);
        return redirect()->route('banner.index');
    }

}
