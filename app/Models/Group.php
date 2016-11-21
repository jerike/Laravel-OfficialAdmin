<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function groupPowers()
    {
        return $this->hasMany('App\Models\GroupPower');
    }

    public function paginateByTitle($string, $perpage)
    {
        return $this->where('title', 'LIKE', "%$string%")
                    ->paginate($perpage);
    }
}
