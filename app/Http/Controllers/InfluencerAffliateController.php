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

use App\Http\Controllers\Helpers\CommonHelper;

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

        if(request('status_key') == 1){ //If status is "Done"
            if(request('class') == 0){ //If class is Influencer
                //Set is_influencer to true
                ProfileController::setIsInfluencer($request->profile_id, 1);
            } else { //Else class is Affliate
                //Set is_affliate to true
                ProfileController::setIsAffliate($request->profile_id, 1);
            }
        } else { //Else status is not "Done"
            if(request('class') == 0){  //If class is Influencer
                //Set is_influencer to false
                ProfileController::setIsInfluencer($request->profile_id, 0);
            } else { //Else class is Affliate
                //Set is_affliate to false
                ProfileController::setIsAffliate($request->profile_id, 0);
            }
        }

        //For setting email_sent status
        if(request('status_key') == 4){
            $row = InfluencerAffliate::where('profile_id', $request->profile_id)->where('class', request('class'))->update(['email_sent' => 1]);
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

        //Create banner
        $banner = CommonHelper::createBanner($row, $type, 'update');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $row, 'banner' => $banner]);
    }

    public static function getInfluencerEntry($profile_id)
    {
        return InfluencerAffliate::where('profile_id', $profile_id)->where('class', 0)->first();
    }

    public static function getAffliateEntry($profile_id)
    {
        return InfluencerAffliate::where('profile_id', $profile_id)->where('class', 1)->first();
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

        $banner = CommonHelper::createBanner($data, 'Date', 'update');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $data, 'banner' => $banner]);
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
