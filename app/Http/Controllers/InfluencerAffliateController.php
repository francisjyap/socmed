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
use App\InfluencerAffliate;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;

use Illuminate\Http\Request;

class InfluencerAffliateController extends Controller
{
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

        //Check for done status and if changing Influencer
        if($request->status_key == 1 && $request->class == 0){
            ProfileController::setIsInfluencer($request->profile_id, 1);
        } 

        //Check for done status and if changing Affliate
        if($request->status_key == 1 && $request->class == 1) {
            ProfileController::setIsAffliate($request->profile_id, 1);
        }

        //Check if changing status from Done to another and if changing Influencer
        if($request->status_key != 1 && $request->class == 0){
            ProfileController::setIsInfluencer($request->profile_id, 0);
        } 

        //Check if changing status from Done to another and if changing Influencer
        if($request->status_key != 1 && $request->class == 1) {
            ProfileController::setIsAffliate($request->profile_id, 0);
        }

        //Check if status is set to Emailed, to change email_sent status in Profile
        if($request->status_key == 4) {
            ProfileController::setEmailSent($request->profile_id, 1);
        } else {
            ProfileController::setEmailSent($request->profile_id, 0);

        }

        //For logs
        LogController::createLog(Auth::id(), $request->profile_id, $request->class, $type, $request->status_key);
        
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
        return InfluencerAffliate::where('profile_id', $profile_id)->where('class', 0)->first();
    }

    public static function getAffliateEntry($profile_id)
    {
        return InfluencerAffliate::where('profile_id', $profile_id)->where('class', 1)->first();
    }
}
