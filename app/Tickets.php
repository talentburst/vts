<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    public $table = 'ticket_details';  
    public $fillable = ['user_id','ticket_id','subject','message','leave_no','from_date','responce','remark','mark_to','responce','responce_by','created_at','updated_at','deleted_at','status'];
}