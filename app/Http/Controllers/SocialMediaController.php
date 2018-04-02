<?php

namespace App\Http\Controllers;

use App\SocialMedia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialMediaTypesController;
use Illuminate\Http\Request;

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
        $types = SocialMediaTypesController::getTypes();

        return view('profiles.addAccount')->with(['profile_id' => $profile_id, 'types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bool = SocialMedia::create([
            'profile_id' => $request->profile_id,
            'username' => $request->username,
            'type' => $request->type,
            'url' => $request->url,
            'followers' => $request->followers
        ]);

        if($bool){
            $msg = 'Account added successfully!';
            $type = 'success';
        }
        else{
            $msg = 'Account adding failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
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
    public function edit(SocialMedia $socialMedia)
    {
        //
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
        $socmed = SocialMedia::find($request->id);

        $socmed->user_id = $request->user_id;
        $socmed->type = $request->type;
        $socmed->username = $request->username;
        $socmed->url = $request->url;
        $socmed->followers = $request->followers;
        $socmed->created_at = now();

        $socmed->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialMedia  $socialMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedia $socialMedia)
    {
        //
    }

    public static function getAccounts($profile_id)
    {
        return SocialMedia::where('profile_id', $profile_id)->get();
    }
}
