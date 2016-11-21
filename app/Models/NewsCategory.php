<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{

    protected $guarded = ['id', 'created_at'];

    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

}
