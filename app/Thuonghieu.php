<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thuonghieu extends Model
{
    protected $table="thuonghieu";
    protected $primaryKey = 'th_id';
    
    public function xuatxu(){
        return $this->belongsTo('App\Xuatxu','xx_id','xx_id');
    }
    public function sanpham(){
        return $this->hasMany('App\Sanpham','th_id','th_id');
    }
}
