<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;
use App\Http\Controllers\SocialMediaController;


class CommonHelper extends Controller
{
    /**
    *	function convertBoolToString
    *	@param Profile $profile
    */
    public static function convertBoolToString($profiles)
    {
        foreach($profiles as $p){
            if($p->is_influencer == 0){
                $p->is_influencer = "No";
            } else {
                $p->is_influencer = "Yes";
            }
            if($p->is_affliate == 0){
                $p->is_affliate = "No";
            } else {
                $p->is_affliate = "Yes";
            }
        }

        return $profiles;
    }

    public static function createBanner($object, $objectName, $action)
    {
        if($object){
            $msg = $objectName .' '. $action . ' success!';
            $type = 'success';
        } else {
            $msg = $objectName .' '. $action . ' failed!';
            $type = 'danger';
        }
        $return = collect(['msg' => $msg, 'type' => $type]);

        return $return;
    }

    public static function profileSort($socmedtype_id, $type)
    {
        $accounts = collect();

        //Get Accounts matching SocMedType ID
        if($socmedtype_id != 0){
            $acc_ids = SocialMediaController::getAccountsWithSocMedType($socmedtype_id);
            foreach($acc_ids as $a){
                $accounts->push(Profile::find($a->profile_id));
            }
        } else {
            $accounts = Profile::all();
        }

        //Filter accounts with type
        $return = null;

        switch($type){
            case 0:
                $return = $accounts;
                break;
            case 1:
                $return = $accounts->where('is_influencer', 1);
                break;
            case 2:
                $return = $accounts->where('is_affliate', 1);
                break;
            case 3:
                $return = $accounts->where('is_influencer', 0);
                break;
            case 4:
                $return = $accounts->where('is_affliate', 0);
                break;
            default:
                $return = null;
                break;
        }

        $return = CommonHelper::convertBoolToString($return);

        //Sort values by Name
        $return = $return->sortBy('name')->values()->all();

        return $return;
    }
}
