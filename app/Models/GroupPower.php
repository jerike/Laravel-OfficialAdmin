<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPower extends Model
{

    protected $guarded = ['id', 'created_at'];

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }

    public function menuNavigation()
    {
        return $this->belongsTo('App\Models\MenuNavigation');
    }

    public function deleteByGroupAndMenuId($group_id, $menu_navigation_id, $menu_id)
    {
        return $this->where('menu_navigation_id', $menu_navigation_id)->where('menu_id', $menu_id)->where('group_id', $group_id)->delete();
    }

}
