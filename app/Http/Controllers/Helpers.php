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

    public static function cleanPhoneNumber($country_code, $phone_number)
    {
        if($country_code){
            if(strpos($country_code, '+') !== false && strpos($country_code, '+') === 0){
                $cleaned_number = $country_code.' ';
            } else {
                $cleaned_number = '+'.$country_code.' ';
            }
        } else {
            $cleaned_number = '';
        }

        if(strlen($phone_number) == 10){
            $cleaned_number = $cleaned_number.substr($phone_number, 0, 3).'-'.substr($phone_number, 3, 3).'-'.substr($phone_number, 6, 4);
        } else if(strlen($phone_number) == 12){
            $cleaned_number = $cleaned_number.$phone_number;
        }

        return $cleaned_number;
    }

    public static function cleanCompanyName($company_name, $name)
    {
        if(!$company_name)
            $company_name = $name;

        return $company_name;
    }

    public static function profileUpdateLog($profile_id, $old, $new)
    {
        if($old->name != $new->name){
            $note = 'Edited Name from '.$old->name.' to '.$new->name;
            NoteController::createLogNote($profile_id, $note);
        }
        if($old->company_name != $new->company_name){
            $note = 'Edited Company Name from '.$old->company_name.' to '.$new->company_name;
            NoteController::createLogNote($profile_id, $note);
        }
        if($old->phone_number != $new->phone_number){
            $old->phone_number ? $old_phone_number = $old->phone_number : $old_phone_number = 'Blank';
            $new->phone_number ? $new_phone_number = $new->phone_number : $new_phone_number = 'Blank';
            $note = 'Edited Phone Number from '.$old_phone_number.' to '.$new_phone_number;
            NoteController::createLogNote($profile_id, $note);
        }
        if($old->country != $new->country){
            $old->country ? $old_country = $old->country : $old_country = 'Blank';
            $new->country ? $new_country = $new->country : $new_country = 'Blank';
            $note = 'Edited Country from '.$old_country.' to '.$new_country;
            NoteController::createLogNote($profile_id, $note);
        }
    }

    public static function profileSetMentionedProductLog($bool, $profile_id)
    {
        if($bool){
            $note = 'Changed mentioned product status to Yes';
        } else{
            $note = 'Changed mentioned product status to No';
        }
        NoteController::createLogNote($profile_id, $note);
    }

    public static function profileSetAffliateCodeLog($affliate_code, $profile_id)
    {
        $note = 'Affliate Code set to: '.$affliate_code;
        NoteController::createLogNote($profile_id, $note);
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

        $return = Helpers::convertBoolToString($return);

        //Sort values by Name
        $return = $return->sortBy('name')->values()->all();

        return $return;
    }
}
