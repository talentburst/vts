<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $table = 'status';  
    public $fillable = ['id','status','created_at','updated_at','is_active'];
}