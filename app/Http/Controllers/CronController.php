<?php

namespace App\Http\Controllers;

use App\CronActivityLog;
use App\CrDrLeaves;
use App\Leaves;
use App\User;


class CronController extends Controller
{
	public function updateLeaves()
	{
		$users = User::select('id')
		->where('status', '=', 1)
	    ->get();

	    foreach ($users as $user) {
		    $user_id = $user->id;
		    $pl_days=1.25;
		    $sl_days=0.50;		

			$ceditDataPL = array(  
				'user_id' => $user_id,
				'updated_by' => 0,        
				'leave_type' => 'Credit PL',
				'credit_leave'=>$pl_days,
				'remark' => 'Auto updated by system admin',
			);

			$ceditDataSL = array(  
				'user_id' => $user_id,
				'updated_by' => 0,        
				'leave_type' => 'Credit SL',
				'credit_leave'=>$sl_days,
				'remark' => 'Auto updated by system admin',
			);       

	        //print_r($debitData); exit;		
			       	
	        $editPL = Leaves::where('user_id', '=', $user_id)->increment('paid_leave',$pl_days);
	        $editSL = Leaves::where('user_id', '=', $user_id)->increment('sick_leave',$sl_days);   

	        if($editPL && $editSL)
	        {
	        	$crPL = CrDrLeaves::create($ceditDataPL);
	        	$crSL = CrDrLeaves::create($ceditDataSL);
	        }
        }

        $cronLogData = array(		  
          'user_id' => 0,
          'log' => 'Cron Executed Successfully',
          'activity' => 'Monthly leaves (PL & SL) credited on employees account'
        );

        CronActivityLog::create($cronLogData);		
		
	}
}