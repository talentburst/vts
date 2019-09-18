<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrDrLeaves extends Model
{
    public $table = 'credit_debit_leaves';  
    public $fillable = ['user_id','ticket_id','updated_by','leave_type','credit_leave','debit_leave','remark','created_at','updated_at'];
}