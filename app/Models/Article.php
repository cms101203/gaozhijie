<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    public $timestamps = false;
    
    public function getdetail(){
        return $this->hasOne('App\Models\Articles', 'id', 'id');
    }
}
