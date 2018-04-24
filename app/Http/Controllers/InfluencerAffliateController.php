<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

namespace App\Http\Controllers;

use Auth;
use App\Log;
use App\InfluencerAffliate;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;

use Illuminate\Http\Request;

class InfluencerAffliateController extends Controller
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
    
    public static function createEntryforProfile($profile_id)
    {
        InfluencerAffliate::create([
            'profile_id' => $profile_id,
            'class' => 0
        ]);

        InfluencerAffliate::create([
            'profile_id' => $profile_id,
            'class' => '1'
        ]);
    }

    /*******
    *   Changes the status of the given type(Status or Follow-up)
    *   and executes specific functions for each type.
    *   
    *   $status_key:
    *       0 - N/A, 1 - Done, 2 - Declined, 3 - Interested, 4 - Emailed, 5 - Rejected
    *   $status_type:
    *       0 - Status, 1 - Follow-up
    *   $class:
    *       0 - Influencer, 1 - Affliate
    *******/
    public function changeStatus(Request $request)
    {        
        $previous = InfluencerAffliate::where('profile_id', $request->profile_id)->where('class', $request->class)->first();
        
        if($request->status_type == 0){
            $type = "Status";
            $row = InfluencerAffliate::where('profile_id', $request->profile_id)->where('class', $request->class)->update([
                'status' => $request->status_key,
                'status_date' => now()
            ]);
            $previous = $previous->status;
        }

        if($request->status_type == 1){
            $type = "Follow-up";
            $row = InfluencerAffliate::where('profile_id', $request->profile_id)->where('class', $request->class)->update([
                'follow-up' => $request->status_key,
                'follow-up_date' => now()
            ]);
            $previous = $previous['follow-up'];
        }

        /*****
        *   Summary:
        *       The (bool)is_influencer and (bool)is_affliate column
        *       is set to "1 (True)" if the Influencer/Affliate Status
        *       is set to "Done"
        *   Condition:
        *       if status_key is set to "Done" AND class is "Influencer"
        *   Effect:
        *       Profile->is_influencer (bool)status is set to 1(True)
        *   Else Condition:
        *       if status_key is set to "Done" AND class is "Affliate"
        *   Else Effect:
        *       Profile->is_affliate (bool)status is set to 1(True)
        *****/
        if($request->status_key == 1 && $request->class == 0){
            ProfileController::setIsInfluencer($request->profile_id, 1);
        } else if($request->status_key == 1 && $request->class == 1) {
            ProfileController::setIsAffliate($request->profile_id, 1);
        }

        // Check if changing status from Done to another and if changing Influencer
        // else changing Affliate
        if($request->status_key != 1 && $request->class == 0){
            ProfileController::setIsInfluencer($request->profile_id, 0);
        } else if($request->status_key != 1 && $request->class == 1) {
            ProfileController::setIsAffliate($request->profile_id, 0);
        }

        //Check if status is set to Emailed, to change email_sent status in Profile
        if($request->status_key == 4) {
            ProfileController::setEmailSent($request->profile_id, 1);
        } else {
            ProfileController::setEmailSent($request->profile_id, 0);

        }

        //For logs
        $log = LogController::createLog(Auth::id(), $request->profile_id, $request->class, $type, $request->status_key);

        if($request->status_type == 0){
            InfluencerAffliate::where('profile_id', $request->profile_id)->where('class', $request->class)->update([
                'latest_inf_log_id' => $log->id
            ]);
        } else if($request->status_type == 1){
            InfluencerAffliate::where('profile_id', $request->profile_id)->where('class', $request->class)->update([
                'latest_aff_log_id' => $log->id
            ]);
        }

        if($row){
            $msg = $type . ' updated successfully!';
            $type = 'success';
        }
        else{
            $msg = $type . ' updating failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $row, 'msg' => $msg, 'type' => $type]);
    }

    public static function getInfluencerEntry($profile_id)
    {
        $var = InfluencerAffliate::where('profile_id', $profile_id)->where('class', 0)->first();
        if($var)
            $var->created_at = substr($var->created_at, 0, 10);

        return $var;
    }

    public static function getAffliateEntry($profile_id)
    {
        $var = InfluencerAffliate::where('profile_id', $profile_id)->where('class', 1)->first();
        if($var)
            $var->created_at = substr($var->created_at, 0, 10);

        return $var;
    }

    public static function editInfAff(Request $request)
    {
        $data = InfluencerAffliate::where('profile_id', $request->profile_id)->where('class', $request->class)->first();

        $orig_status_date = $data->status_date;
        $orig_follow_up_date = $data['follow-up_date'];

        $data->status_date = $request->status_date;
        $data['follow-up_date'] = $request->follow_up_date;
        $data->save();

        //Edit Log
        if($data->latest_inf_log_id != null){
            $log = Log::where('id', $data->latest_inf_log_id)->first();
            $log->created_at = $request->status_date;
            $log->save();
        }

        if($data->latest_aff_log_id != null){
            $log = Log::where('id', $data->latest_aff_log_id)->first();
            $log->created_at = $request->follow_up_date;
            $log->save();
        }

        if($data){
            $msg = 'Date updated successfully!';
            $type = 'success';
        }
        else{
            $msg = 'Date updating failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $data, 'msg' => $msg, 'type' => $type]);
    }

    public static function editInf($profile_id)
    {
        $data = InfluencerAffliate::where('profile_id', $profile_id)->where('class', 0)->first();
        $status_date = substr($data['status_date'],0,10);
        $follow_up_date = substr($data['follow-up_date'],0,10);
        return view('editInf')->with(['data' => $data, 'profile_id'=>$profile_id, 'status_date'=>$status_date, 'follow_up_date'=>$follow_up_date]);
    }

    public static function editAff($profile_id)
    {
        $data = InfluencerAffliate::where('profile_id', $profile_id)->where('class', 1)->first();
        $status_date = substr($data['status_date'],0,10);
        $follow_up_date = substr($data['follow-up_date10'],0,10);
        return view('editAff')->with(['data' => $data, 'profile_id'=>$profile_id, 'status_date'=>$status_date, 'follow_up_date'=>$follow_up_date]);
    }
}
