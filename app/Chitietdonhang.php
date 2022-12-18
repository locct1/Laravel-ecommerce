<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    protected $table="chitietdonhang";
    protected $primaryKey = 'ct_id';
    public function donhang(){
        return $this->belongsTo('App\Donhang','dh_id','dh_id');
    }
    public function sanpham(){
        return $this->belongsTo('App\Sanpham','sp_id','sp_id');
    }
}
