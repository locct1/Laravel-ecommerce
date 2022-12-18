<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model
{
    protected $table="sanpham";
    protected $primaryKey = 'sp_id';
    public function thuonghieu(){
        return $this->belongsTo('App\Thuonghieu','th_id','th_id');
    }
    public function comment(){
        return $this->hasMany('App\Comment','sp_id','sp_id');
    }
    public function chitietdonhang(){
        return $this->hasMany('App\Chitietdonhang','sp_id','sp_id');
    }
}
