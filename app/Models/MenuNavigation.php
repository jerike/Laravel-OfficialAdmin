<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuNavigation extends Model
{

    protected $guarded = ['id', 'created_at'];

    public function groupPowers()
    {
        return $this->hasMany('App\Models\GroupPower');
    }

    public function menus()
    {
        return $this->hasMany('App\Models\Menu');
    }

}
