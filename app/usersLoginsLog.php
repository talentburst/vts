<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersLoginsLog extends Model
{
    public $table = 'users_logins_log';  
    public $fillable = ['id','user_id','sessionid','loginDateTime','logoutDateTime','ip','browser','browser_version','platform','platform_version','isDesktop','isPhone','isRobot','full_user_agent_string','created_at','updated_at'];
}