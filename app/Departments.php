<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{	
	public $timestamps = false;
    public $table = 'departments';  
    public $fillable = ['id','name','description','status','created_at','updated_at'];
}