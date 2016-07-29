<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    //添加这两个，最下面的，因为我是手工建表
    protected $table = 'category';
    public $timestamps = false;
    public function giveRoleTo(array $RolesId){
        $this->detachRoles();
        $this->attachRolesToId($RolesId);
    }
}
