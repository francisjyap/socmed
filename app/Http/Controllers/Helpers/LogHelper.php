<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogHelper extends Controller
{
	public static function convertFieldDataToString($logs)
	{
	    foreach($logs as $log){
            switch($log->field_data){
                case 0:
                    $log->field_data = "N/A";
                    break;
                case 1:
                    $log->field_data = "Done";
                    break;
                case 2:
                    $log->field_data = "Declined";
                    break;
                case 3:
                    $log->field_data = "Interested";
                    break;
                case 4:
                    $log->field_data = "Emailed";
                    break;
                case 5:
                    $log->field_data = "Rejected";
                    break;
            }
        }
        
        return $logs;
	}
}
