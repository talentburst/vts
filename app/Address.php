<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{	
	public $timestamps = false;
    public $table = 'users_address';  
    public $fillable = ['user_id','address','city','state','country','pincode','landmark','cur_address','cur_city','cur_state','cur_country','cur_pincode','cur_landmark','created_at','updated_at'];
}