<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hinhthucthanhtoan extends Model
{
    protected $table="hinhthucthanhtoan";
    protected $primaryKey = 'ht_id';
    public function donhang(){
        return $this->hasMany('App\Donhang','th_id','th_id');
    }
}
