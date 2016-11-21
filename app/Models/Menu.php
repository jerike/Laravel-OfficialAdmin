<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $guarded = ['id', 'created_at'];

    public function groupPowers()
    {
        return $this->hasMany('App\Models\GroupPower');
    }

    public function menuNavigation()
    {
        return $this->belongsTo('App\Models\MenuNavigation');
    }

}
