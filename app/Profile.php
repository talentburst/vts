<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{	
	public $timestamps = false;
    public $table = 'users_profile';  
    public $fillable = ['user_id','emp_id','title','department','dob','doj','location','aadhar_no','pan_no','aadhar_image','pan_image','profile_image','total_exp','relevant_exp','created_at','updated_at'];
}