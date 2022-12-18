<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usernhanhang extends Model
{
    protected $table="users_nhanhang";
    protected $primaryKey = 'nh_id';
    public function donhang(){
        return $this->hasMany('App\Donhang','nh_id','nh_id');
    }
}
