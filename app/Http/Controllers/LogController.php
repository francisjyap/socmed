<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public static function createLog($user_id, $profile_id, $class, $field_name, $field_data)
    {
        return Log::create([
            'user_id' => $user_id,
            'profile_id' => $profile_id,
            'type' => $class,
            'field_name' => $field_name,
            'field_data' => $field_data
        ]);
    }

    public function getInfHistory($profile_id)
    {
        $logs = Log::where('profile_id', $profile_id)->where('type', 0)->get();

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

    public function getAffHistory($profile_id)
    {
        $logs = Log::where('profile_id', $profile_id)->where('type', 1)->get();

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