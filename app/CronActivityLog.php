<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CronActivityLog extends Model
{	
	public $timestamps = false;
    public $table = 'cron_activity_log';  
    public $fillable = ['user_id','log','activity','created_at','updated_at'];
}