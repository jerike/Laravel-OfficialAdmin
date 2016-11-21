<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GroupPower;
use App\Models\Group;
use App\Models\Menu;
use Illuminate\Http\Request;

class GroupPowerController extends Controller
{

    protected $group_power;
    protected $group;
    protected $menu;

    public function __construct(Group $group, GroupPower $group_power, Menu $menu)
    {
        $this->group_power = $group_power;
        $this->group = $group;
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view_data_arr['groups'] = $this->group->all();
        $view_data_arr['menus'] = $this->menu->all();
        return view('group_power.index', $view_data_arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function change(Request $request)
    {
        $menu_navigation_id = $request->input('menu_navigation_id');
        $menu_id = $request->input('menu_id');
        $group_id = $request->input('group_id');
        $status = $request->input('status');
        $result = false;
        if($status == 'no'){
            $data = ['group_id' => $group_id, 'menu_navigation_id' => $menu_navigation_id, 'menu_id' => $menu_id];
            $result = $this->group_power->create($data);
        }else if($status == 'yes'){
            $result = $this->group_power->deleteByGroupAndMenuId($group_id, $menu_navigation_id, $menu_id);
        }
        return $result == true ? 'success' : 'fail';
    }

}

?>