<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function newsPublish()
    {
        return $this->hasOne('App\Models\NewsPublish');
    }

    public function newsCategory()
    {
        return $this->belongsTo('App\Models\NewsCategory');
    }

    public function paginateByTitleOrContent($string, $perpage)
    {
        return $this->where('title', 'LIKE', "%$string%")->orWhere('content', 'LIKE',"%$string%")->paginate($perpage);
    }

}
