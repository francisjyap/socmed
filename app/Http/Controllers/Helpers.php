<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class Helpers extends Controller
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
}
