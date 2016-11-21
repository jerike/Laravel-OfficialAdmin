<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuNavigation;
use App\Http\Requests\MenuFormRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    const PER_PAGE = 10;

    protected $menu_nav;
    protected $menu;

    public function __construct(Menu $menu, MenuNavigation $menu_navigatation )
    {
        $this->menu = $menu;
        $this->menu_navigatation = $menu_navigatation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $view_data_arr['menus'] = $this->menu->paginate(self::PER_PAGE);

        return view('menu.index', $view_data_arr);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $view_data_arr['menu_navigatations'] = $this->menu_navigatation->lists('title', 'id');
        return view('menu.create', $view_data_arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(MenuFormRequest $request)
    {
        $data = $request->all();
        $this->menu->create($data);
        return redirect()->route('menu.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $view_data_arr['menu'] = $this->menu->find($id);
        $view_data_arr['menu_navigatations'] = $this->menu_navigatation->lists('title', 'id');
        return view('menu.edit', $view_data_arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(MenuFormRequest $request, $id)
    {
        $data['title'] = $request->input('title');
        $data['link'] = $request->input('link');
        $data['rank'] = $request->input('rank');
        $data['target'] = $request->input('target');
        $data['menu_navigation_id'] = $request->input('menu_navigation_id');

        $this->menu->find($id)->update($data);

        return redirect()->route('menu.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->menu->destroy($id);
        return redirect()->route('menu.index');
    }

}
