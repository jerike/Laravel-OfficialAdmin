<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPublish extends Model
{

	protected $guarded = ['id', 'created_at'];

    public function news()
    {
        return $this->belongsTo('App\Models\News');
    }

}
