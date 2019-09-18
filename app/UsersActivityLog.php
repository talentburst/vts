<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersActivityLog extends Model
{
    public $table = 'users_activity_log';  
    public $fillable = ['id','user_id','log','activity','created_at','updated_at'];
}