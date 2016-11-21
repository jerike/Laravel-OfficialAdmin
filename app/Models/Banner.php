<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function paginateByTitle($search_str, $perpage)
    {
        return $this->where('title', 'LIKE', "%{$search_str}%")->paginate($perpage);
    }
}
