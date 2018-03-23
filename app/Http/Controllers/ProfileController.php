<?php

namespace App\Http\Controllers;

use App\Profile;
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

    public function index()
    {
        return view('profiles');
    }

    public function getProfiles()
    {
        return Profile::all();
    }

    public function store(Request $request)
    {
        return Profile::create([
            'email' => $request->email,
            'name' => $request->name,
            'website' => $request->website,
            'country' => $request->country,
            'is_affliate' => $request->is_affliate,
            'is_influencer' => $request->is_influencer,
            'mentioned_product' => $request->mentioned_product
        ]);
    }

    public function update(Request $request)
    {
        return Profile::find($request->id)
            ->update([
                'email' => $request->email,
                'name' => $request->name,
                'website' => $request->website,
                'country' => $request->country,
                'is_affliate' => $request->is_affliate,
                'is_influencer' => $request->is_influencer,
                'mentioned_product' => $request->mentioned_product
            ]);
    }

    public function setAffliate(Request $request)
    {
        $profile = Profile::find($request->id)->update(['is_affliate' => $request->is_affliate]);
    }

    public function setInfluencer(Request $request)
    {
        $profile = Profile::find($request->id)->update(['is_influencer' => $request->is_influencer]);    }

}
