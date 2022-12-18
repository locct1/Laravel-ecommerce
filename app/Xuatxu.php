<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xuatxu extends Model
{
    protected $table="xuatxu";
    protected $primaryKey = 'xx_id';
    public function thuonghieu(){
        return $this->hasMany('App\Thuonghieu','xx_id','xx_id');
    }
}
