<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SocialMediaTypesController;
use Illuminate\Http\Request;

class ProfileController extends Controller
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

    /*****
        Display Index Page
    *****/
    public function index()
    {
        return view('profiles.profilelist');
    }

    /*****
        Display viewProfile Page
    *****/
    public function viewProfile($profile_id)
    {
        $profile = Profile::find($profile_id);
        $emails = EmailController::getEmails($profile_id);
        $socmed = SocialMediaController::getAccounts($profile_id);
        $types = SocialMediaTypesController::getTypes();

        return view('profiles.viewProfile')->with(['profile'=>$profile, 'emails'=>$emails, 'socmed'=>$socmed, 'types'=> $types]);
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
        return Profile::all();
    }

    public function store(Request $request)
    {
        $bool = Profile::create([
            'email' => $request->email,
            'name' => $request->name,
            'website' => $request->website,
            'country' => $request->country
        ]);

        if($bool){
            $msg = 'Profile created successfully!';
            $type = 'success';
        }
        else{
            $msg = 'Profile creation failed!';
            $type = 'danger';
        }

        return view('profiles.profilelist')->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function update(Request $request)
    {
        $bool = Profile::find($request->id)->update([
                'email' => $request->email,
                'name' => $request->name,
                'website' => $request->website,
                'country' => $request->country
            ]);

        if($bool){
            $msg = 'Profile edited successfully!';
            $type = 'success';
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

        return view('profiles.profilelist')->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function setAffliate(Request $request)
    {
        $profile = Profile::find($request->id)->update(['is_affliate' => $request->is_affliate]);
    }

    public function setInfluencer(Request $request)
    {
        $profile = Profile::find($request->id)->update(['is_influencer' => $request->is_influencer]);    }

}
