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
        //Validate request
        $this->validate(request(), [
            'name' => 'required|unique:profiles',
            'email' => 'required|email',
        ]);            

        //Field cleaning
        $company_name = Helpers::cleanCompanyName(request('company_name'), request('name'));
        $phone_number = Helpers::cleanPhoneNumber(request('country_code'), request('phone_number'));

        //Create Profile
        $profile = Profile::create([
            'name' => request('name'),
            'company_name' => $company_name,
            'phone_number' => $phone_number,
            'country' => request('country')
        ]);

        //Create Email, Website, InfluencerAffliate entries
        EmailController::staticStore($profile->id, request('email'));
        WebsiteController::staticStore($profile->id, request('website'));
        InfluencerAffliateController::createEntryforProfile($profile->id);

        //Create banner message
        $banner = Helpers::createBanner($profile, 'Profile', 'create');

        //Redirect
        return redirect()->action('ProfileController@index')->with(['status' => $profile, 'banner' => $banner]);
    }

    public function update(Request $request)
    {
        //Validate Request
        $this->validate(request(), [
            'name' => 'required'
        ]);

        //Save instance of Profile before update
        $old = Profile::find(request('id'));

        //Field cleaning
        $company_name = Helpers::cleanCompanyName(request('company_name'), request('name'));

        //Update Profile
        $bool = Profile::find(request('id'))->update([
                'name' => request('name'),
                'company_name' => $company_name,
                'phone_number' => request('phone_number'),
                'country' => request('country')
        ]);
        
        //Save instance of Profile after update
        $new = Profile::find(request('id'));

        //If profile created successfully
        if($bool){
            //Log changes
            Helpers::profileUpdateLog(request('id'), $old, $new);
        }

        //Create banner message
        $banner = Helpers::createBanner($bool, 'Profile', 'edit');

        //Redirect
        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public function delete(Request $request)
    {
        //Find Profile with ID and delete
        $profile = Profile::find(request('id'));
        $bool = $profile->delete();

        //Create banner message
        $banner = Helpers::createBanner($bool, 'Profile', 'delete');

        //Redirect
        return redirect()->action('ProfileController@index')->with(['status' => $bool, 'banner' => $banner]);

    }

    public static function setIsInfluencer($profile_id, $bool)
    {
        return Profile::find($profile_id)->update(['is_influencer' => $bool]);
    }

    public static function setIsAffliate($profile_id, $bool)
    {
        return Profile::find($profile_id)->update(['is_affliate' => $bool]);
    }

    public function setMentionedProduct(Request $request)
    {
        $this->validate(request(), [
            'profile_id' => 'required',
            'bool' => 'required'
        ]);

        //Update
        $bool = Profile::find(request('profile_id'))->update([
            'mentioned_product' => request('bool')
        ]);

        //If update successful
        if($bool){
            //Log changes
            Helpers::profileSetMentionedProductLog(request('bool'), request('profile_id'));
        }

        //Create banner message
        $banner = Helpers::createBanner($bool, 'Mentioned product', 'status change');
        
        //Redirect
        return redirect()->action('ProfileController@viewProfile', ['profile_id' => request('profile_id')])->with(['status' => $bool, 'banner' => $banner]);
    }

    public function setAffliateCode(Request $request)
    {
        //Validate
        $this->validate(request(), [
            'profile_id' => 'required',
        ]);

        //Update
        $profile = Profile::find(request('profile_id'));
        $profile->affliate_code = request('affliate_code');
        $bool = $profile->save();

        //If update successful
        if($bool){
            //Log changes
            Helpers::profileSetAffliateCodeLog(request('affliate_code'), request('profile_id'));
        }

        //Create banner message
        $banner = Helpers::createBanner($bool, 'Affliate Code', 'set');

        //Redirect
        return redirect()->action('ProfileController@viewProfile', ['profile_id' => request('profile_id')])->with(['status' => $bool, 'banner' => $banner]);
    }
}
