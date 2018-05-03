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
use Illuminate\Http\Request;

use App\Email;

use App\Http\Controllers\Helpers\CommonHelper;
use App\Http\Controllers\Helpers\ProfileHelper;

use App\Http\Controllers\LogController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SocialMediaTypesController;
use App\Http\Controllers\InfluencerAffliateController;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('profiles.profilelist')->with([
            'types' => SocialMediaTypesController::getTypes(),
        ]);
    }
    
    public function viewProfile($profile_id)
    {
        $profile = ProfileHelper::cleanProfile(Profile::find($profile_id));
        $types = SocialMediaTypesController::getTypes();
        $influencer = InfluencerAffliateController::getInfluencerEntry($profile_id);
        $affliate = InfluencerAffliateController::getAffliateEntry($profile_id);
        $infHistory = LogController::getInfHistory($profile_id);
        $affHistory = LogController::getAffHistory($profile_id);
        
        return view('profiles.viewProfile', compact([
            'profile', 'types', 'influencer', 'affliate', 'infHistory', 'affHistory'    
        ]));
    }
    
    public function create()
    {
        return view('profiles.addProfile');
    }
    
    public function edit($id)
    {
        return view('profiles.editProfile')->with(['profile' => Profile::find($id)]);
    }
    
    public static function getProfiles()
    {
        return ProfileHelper::cleanProfiles(Profile::all());
    }

    protected function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|unique:profiles',
            'email' => 'required|email|unique:emails',
            'country' => 'nullable|alpha',
            'payment_email' => 'nullable|email'
        ]);            
        
        $company_name = ProfileHelper::cleanCompanyName(request('company_name'), request('name'));
        $phone_number = ProfileHelper::cleanPhoneNumber(request('country_code'), request('phone_number'));
        
        $profile = Profile::create([
            'name' => request('name'),
            'company_name' => $company_name,
            'country_code' => $phone_number['country_code'],
            'phone_number' => $phone_number['phone_number'],
            'country' => request('country'),
            'payment_email' => request('payment_email')
        ]);
        
        EmailController::staticStore($profile->id, request('email'));
        WebsiteController::staticStore($profile->id, request('website'));
        InfluencerAffliateController::createEntryforProfile($profile->id);
        
        $banner = CommonHelper::createBanner($profile, 'Profile', 'create');
        
        return redirect()->action('ProfileController@index')->with(['status' => $profile, 'banner' => $banner]);
    }

    protected function update(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'country' => 'nullable|alpha',
            'payment_email' => 'nullable|email'
        ]);
        
        $old = Profile::find(request('id'));
        
        $company_name = ProfileHelper::cleanCompanyName(request('company_name'), request('name'));
        $phone_number = ProfileHelper::cleanPhoneNumber(request('country_code'), request('phone_number'));
        
        $bool = Profile::find(request('id'))->update([
            'name' => request('name'),
            'company_name' => $company_name,
            'country_code' => $phone_number['country_code'],
            'phone_number' => $phone_number['phone_number'],
            'country' => request('country'),
            'payment_email' => request('payment_email')
        ]);
        
        $new = Profile::find(request('id'));
        
        if($bool){
            ProfileHelper::profileUpdateLog(request('id'), $old, $new);
        }
        
        $banner = CommonHelper::createBanner($bool, 'Profile', 'edit');
        
        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->id])->with(['status' => $bool, 'banner' => $banner]);
    }

    protected function delete(Request $request)
    {
        $profile = Profile::find(request('id'));
        $bool = $profile->delete();
        $banner = CommonHelper::createBanner($bool, 'Profile', 'delete');
        
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
        
        $bool = Profile::find(request('profile_id'))->update([
            'mentioned_product' => request('bool')
        ]);
        
        if($bool){
            ProfileHelper::profileSetMentionedProductLog(request('bool'), request('profile_id'));
        }
        
        $banner = CommonHelper::createBanner($bool, 'Mentioned product', 'status change');
        
        return redirect()->action('ProfileController@viewProfile', ['profile_id' => request('profile_id')])->with(['status' => $bool, 'banner' => $banner]);
    }

    public function setAffliateCode(Request $request)
    {
        $this->validate(request(), [
            'profile_id' => 'required',
        ]);
        
        $profile = Profile::find(request('profile_id'));
        $profile->affliate_code = request('affliate_code');
        $bool = $profile->save();
        
        if($bool){
            ProfileHelper::profileSetAffliateCodeLog(request('affliate_code'), request('profile_id'));
        }
        
        $banner = CommonHelper::createBanner($bool, 'Affliate Code', 'set');
        
        return redirect()->action('ProfileController@viewProfile', ['profile_id' => request('profile_id')])->with(['status' => $bool, 'banner' => $banner]);
    }
}
