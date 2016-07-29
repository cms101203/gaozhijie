<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Xm extends Model
{
    protected $table = 'xm';
    public $timestamps = false;
    
    public function getdetail(){
        return $this->hasOne('App\Models\Xmdetail', 'id', 'id');
    }
}
