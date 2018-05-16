<?php

namespace App\Http\Controllers;

use App\SocialMedia;
use Illuminate\Http\Request;

use App\Profile;

use App\Http\Controllers\Helpers\CommonHelper;
use App\Http\Controllers\Helpers\SocialMediaHelper;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialMediaTypesController;

class SocialMediaController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($profile_id)
    {
        return view('account.addAccount')->with([
            'profile_id' => $profile_id,
            'types' => SocialMediaTypesController::getTypes()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $this->validate(request(), [
            'profile_id' => 'required',
            'username' => 'required',
            'type' => 'required',
            'url' => 'required|unique:social_media',
        ]);

        //Create new Social Media entry
        $bool = SocialMedia::create([
            'profile_id' => $request->profile_id,
            'username' => $request->username,
            'type' => $request->type,
            'url' => $request->url,
            'followers' => $request->followers
        ]);

        //If add successful
        if($bool){
            //Log changes
            SocialMediaHelper::storeLog(request('username'), request('profile_id'));
        }

        //Create banner message
        $banner = CommonHelper::createBanner($bool, 'Account', 'add');

        //Redirect
        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function show(SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('account.editAccount')->with([
            'account' => SocialMedia::find($id),
            'types' => SocialMediaTypesController::getTypes()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate(request(), [
            'type' => 'required',
            'username' => 'required',
            'url' => 'required',
        ]);

        $old = SocialMedia::find($request->id);

        $bool = SocialMedia::find($request->id)->update([
            'type' => $request->type,
            'username' => $request->username,
            'url' => $request->url,
            'followers' => $request->followers,
        ]);

        $new = SocialMedia::find($request->id);

        if($bool){
            SocialMediaHelper::updateLog($old, $new);
        }

        $banner = CommonHelper::createBanner($bool, 'Account', 'update');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $new->profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $socmed = SocialMedia::find($request->id);
        $deleted = $socmed->username;
        $deleted_profile_id = $socmed->profile_id;
        $bool = $socmed->delete();

        if($bool){
            SocialMediaHelper::destroyLog($deleted_profile_id, $deleted);
        }

        $banner = CommonHelper::createBanner($bool, 'Account', 'delete');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $socmed->profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public static function getAccounts($profile_id)
    {
        return SocialMedia::where('profile_id', $profile_id)->get();
    }

    public static function getAccountsWithSocMedType($socmedtype_id)
    {
        if($socmedtype_id != 0){
            $entries = SocialMedia::where('type', $socmedtype_id)->get();
        } else {
            $entries = SocialMedia::all();
        }

        return $entries->unique('profile_id');
    }
}
