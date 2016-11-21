<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $guarded = ['id', 'created_at'];

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function paginateByEmailOrUidOrUsername($string, $perpage)
    {
        return $this->where('email', 'LIKE', "%$string%")
                    ->orWhere('uid', 'LIKE', "%$string%")
                    ->orWhere('username', 'LIKE', "%$string%")
                    ->paginate($perpage);
    }

    public function checkPassByEmail($email)
    {
        return $this->where('email', $email)->get()->isEmpty() ? false : true;
    }

    public function getInfoByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function findByUID($uid)
    {
        return $this->where('uid', $uid)->first();
    }

}
