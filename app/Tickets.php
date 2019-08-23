<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    public $table = 'ticket_details';  
    public $fillable = ['user_id','mark_to','responce_by','ticket_id','name','email','subject','message','responce','remark','created_at'];
}