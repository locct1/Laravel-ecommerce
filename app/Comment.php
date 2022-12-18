<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="binhluan";
    protected $primaryKey = 'bl_id';
    public function sanpham(){
        return $this->belongsTo('App\Sanpham','sp_id','sp_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id','user_id');
    }
}
