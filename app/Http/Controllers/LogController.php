<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

namespace App\Http\Controllers;

use App\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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

    public function createHistory(Request $req)
    {
        $bool = Log::create([
            'user_id' => $req->user_id,
            'profile_id' => $req->profile_id,
            'type' => $req->class,
            'field_name' => $req->field_name,
            'field_data' => $req->field_data,
            'created_at' => new Carbon($req->date)
        ]);

        if($bool){
            $msg = 'Profile edited successfully!';
            $type = 'success';
        }
        else{
            $msg = 'Profile editing failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $req->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
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
