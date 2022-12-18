<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    protected $table="donhang";
    protected $primaryKey = 'dh_id';
    public function user(){
        return $this->belongsTo('App\User','user_id','user_id');
    }
    public function hinhthucthanhtoan(){
        return $this->belongsTo('App\Hinhthucthanhtoan','ht_id','ht_id');
    }
    public function usernhanhang(){
        return $this->belongsTo('App\Usernhanhang','nh_id','nh_id');
    }
    public function chitietdonhang(){
        return $this->hasMany('App\Chitietdonhang','dh_id','dh_id');
    }
}
