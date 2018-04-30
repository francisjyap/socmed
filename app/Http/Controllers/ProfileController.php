<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

namespace App\Http\Controllers;

use App\Profile;
use App\Http\Controllers\Helpers;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SocialMediaTypesController;
use App\Http\Controllers\InfluencerAffliateController;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    *   Display Index Page
    **/
    public function index()
    {
        $types = SocialMediaTypesController::getTypes();

        return view('profiles.profilelist')->with(['types' => $types]);
    }

    /**
    *   Display viewProfile Page
    */
    public function viewProfile($profile_id)
    {
        $profile = Profile::find($profile_id);
        $emails = EmailController::getEmails($profile_id);
        $websites = WebsiteController::getWebsites($profile_id);
        $socmed = SocialMediaController::getAccounts($profile_id);
        $types = SocialMediaTypesController::getTypes();
        $influencer = InfluencerAffliateController::getInfluencerEntry($profile_id);
        $affliate = InfluencerAffliateController::getAffliateEntry($profile_id);

        $infHistory = LogController::getInfHistory($profile_id);
        $affHistory = LogController::getAffHistory($profile_id);

        return view('profiles.viewProfile')->with([
            'profile'=>$profile, 
            'emails'=>$emails, 
            'websites'=>$websites, 
            'socmed'=>$socmed, 
            'types'=> $types, 
            'influencer'=>$influencer, 
            'affliate'=>$affliate, 
            'infHistory'=>$infHistory, 
            'affHistory'=>$affHistory
        ]);
    }

    /*****
        Display addProfile Page
    *****/
    public function create()
    {
        return view('profiles.addProfile');
    }

    /*****
        Display editProfile Page
    *****/
    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('profiles.editProfile')->with(['profile' => $profile]);
    }

    /*****
        Return all profile entries
    *****/
    public function getProfiles()
    {
        $profiles = Helpers::convertBoolToString(Profile::all());

        $profiles = $profiles->sortBy('name')->values()->all();

        return $profiles;
    }

    protected function store(Request $request)
    {
        if($request->company_name)
            $company_name = $request->company_name;
        else
            $company_name = $request->name;

        $profile = Profile::create([
            'name' => $request->name,
            'company_name' => $company_name,
            'phone_number' => $request->phone_number,
            'country' => $request->country
        ]);

        //Create Email and Website entries
        EmailController::staticStore($profile->id, $request->email);
        WebsiteController::staticStore($profile->id, $request->website);

        //Create InfluencerAffliate entry
        InfluencerAffliateController::createEntryforProfile($profile->id);

        if($profile){
            $msg = 'Profile created successfully!';
            $type = 'success';
        }
        else{
            $msg = 'Profile creation failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@index')->with(['status' => $profile, 'msg' => $msg, 'type' => $type]);
    }

    public function update(Request $request)
    {
        $old = Profile::find($request->id);

        if($request->company_name)
            $company_name = $request->company_name;
        else
            $company_name = $request->name;

        $bool = Profile::find($request->id)->update([
                'name' => $request->name,
                'company_name' => $company_name,
                'phone_number' => $request->phone_number,
                'country' => $request->country
            ]);
        
        $new = Profile::find($request->id);

        if($bool){
            $msg = 'Profile edited successfully!';
            $type = 'success';
            if($old->name != $new->name){
                $note = 'Edited Name from '.$old->name.' to '.$new->name;
                NoteController::createLogNote($request->id, $note);
            }
            if($old->company_name != $new->company_name){
                $note = 'Edited Company Name from '.$old->company_name.' to '.$new->company_name;
                NoteController::createLogNote($request->id, $note);
            }
            if($old->phone_number != $new->phone_number){
                $old->phone_number ? $old_phone_number = $old->phone_number : $old_phone_number = 'Blank';
                $new->phone_number ? $new_phone_number = $new->phone_number : $new_phone_number = 'Blank';
                $note = 'Edited Phone Number from '.$old_phone_number.' to '.$new_phone_number;
                NoteController::createLogNote($request->id, $note);
            }
            if($old->country != $new->country){
                $note = 'Edited Country from '.$old->country.' to '.$new->country;
                NoteController::createLogNote($request->id, $note);
            }
        }
        else{
            $msg = 'Profile editing failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function delete(Request $request)
    {
        $profile = Profile::find($request->id);
        $bool = $profile->delete();

        if($bool){
            $msg = 'Profile deleted!';
            $type = 'success';
        } else {
            $msg = 'Profile failed to delete!';
            $type = 'fail';
        }

        return redirect()->action('ProfileController@index')->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);

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

    public static function setIsInfluencer($profile_id, $bool)
    {
        return Profile::find($profile_id)->update(['is_influencer' => $bool]);
    }

    public static function setIsAffliate($profile_id, $bool)
    {
        return Profile::find($profile_id)->update(['is_affliate' => $bool]);
    }

    public static function setEmailSent($profile_id, $bool)
    {
        return Profile::find($profile_id)->update(['email_sent' => $bool]);
    }

    public static function setMentionedProduct(Request $request)
    {
        $bool = Profile::find($request->profile_id)->update(['mentioned_product' => $request->bool]);

        if($bool){
            $msg = 'Mentioned product status changed successfully!';
            $type = 'success';
            if($request->bool){
                $note = 'Changed mentioned product status to Yes';
            } else{
                $note = 'Changed mentioned product status to No';
            }
            NoteController::createLogNote($request->profile_id, $note);
        }
        else{
            $msg = 'Mentioned product status change failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }
}
