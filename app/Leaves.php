<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{	
	public $timestamps = false;
    public $table = 'leave_details';  
    public $fillable = ['user_id','paid_leave','sick_leave','casual_leave','other_leave','created_at','updated_at'];
}