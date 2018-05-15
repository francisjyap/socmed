<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\CommonHelper;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NoteController;

class ProfileHelper extends Controller
{
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
        return NoteController::createLogNote($profile_id, $note);
    }

    public static function profileSetAffliateCodeLog($affliate_code, $profile_id)
    {
        $note = 'Affliate Code set to: '.$affliate_code;
        return NoteController::createLogNote($profile_id, $note);
    }

    public static function cleanProfile($profile)
    {
        $profile->phone_number = $profile->country_code.' '.$profile->phone_number;
        
        return $profile;
    }
    
    public static function cleanProfiles($profiles)
    {
        $return = CommonHelper::convertBoolToString($profiles);

        $return = $return->sortBy('name')->values()->all();

        foreach($return as $p){
            $p->phone_number = $p->country_code.' '.$p->phone_number;
        }
        
        $profile = ProfileHelper::getInfAffEmailStatus($profiles);

        return $return;
    }
    
    public static function getInfAffEmailStatus($profiles)
    {
        foreach($profiles as $profile){
            foreach($profile->infaff as $a){
                if($a->class === 0)
                    $influencer  = $a;
                else
                    $affliate = $a;
            }
            if($influencer->email_sent)
                $profile['emailed_influencer'] = 'Yes';
            else
                $profile['emailed_influencer'] = 'No';
            
            if($affliate->email_sent)
                $profile['emailed_affliate'] = 'Yes';
            else
                $profile['emailed_affliate'] = 'No';
        }
        
        return $profiles;
    }

    public static function cleanPhoneNumber($country_code, $phone_number)
    {
        if($country_code){
            //If country code has '+' symbol
            if(strpos($country_code, '+') !== false && strpos($country_code, '+') === 0){
                $code = $country_code;
            } else { //else add '+' symbol
                $code = '+'.$country_code;
            }
        } else {
            $code = '';
        }

        $cleaned_number = '';
        
        //For 8 Digit numbers
        if(strlen($phone_number) == 8){
            $cleaned_number = $cleaned_number.substr($phone_number, 0, 2).'-'.substr($phone_number, 3, 3).'-'.substr($phone_number, 6, 3);
        } else if(strlen($phone_number) == 10 && strpos($cleaned_number, '-') !== false){
            $cleaned_number = $cleaned_number.$phone_number;
        }
        
        //For 9 Digit numbers
        if(strlen($phone_number) == 9){
            $cleaned_number = $cleaned_number.substr($phone_number, 0, 3).'-'.substr($phone_number, 3, 3).'-'.substr($phone_number, 6, 3);
        } else if(strlen($phone_number) == 11 && strpos($cleaned_number, '-') !== false){
            $cleaned_number = $cleaned_number.$phone_number;
        }
        
        //For 10 Digit Numbers
        if(strlen($phone_number) == 10){
            $cleaned_number = $cleaned_number.substr($phone_number, 0, 3).'-'.substr($phone_number, 3, 3).'-'.substr($phone_number, 6, 4);
        } else if(strlen($phone_number) == 12 && strpos($cleaned_number, '-') !== false){
            $cleaned_number = $cleaned_number.$phone_number;
        }

        return collect(['country_code' => $code, 'phone_number' => $cleaned_number]);
    }

    public static function cleanCompanyName($company_name, $name)
    {
        if(!$company_name)
            $company_name = $name;

        return $company_name;
    }
    
}
