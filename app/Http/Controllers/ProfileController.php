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

    public function store(Request $request)
    {
        // $profile = new Profile;

        // $profile-> = $request->email;
        // $profile->name = $request->name;
        // $profile->website = $request->website;
        // $profile->country = $request->country;
        // $profile->is_affliate = $request->is_affliate;
        // $profile->is_influencer = $request->is_influencer;
        // $profile->mentioned_product = $request->mentioned_product;
        // $profile->created_at = now();

        // $profile->save();

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
        // $profile = Profile::find($request->id);

        // $profile->email = $request->email;
        // $profile->name = $request->name;
        // $profile->website = $request->website;
        // $profile->country = $request->country;
        // $profile->is_affliate = $request->is_affliate;
        // $profile->is_influencer = $request->is_influencer;
        // $profile->mentioned_product = $request->mentioned_product;
        // $profile->updated_at = now();

        // $profile->save();

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

        // $profile->is_affliate = $request->is_affliate;

        // $profile->save();

    }

    public function setInfluencer(Request $request)
    {
        $profile = Profile::find($request->id)->update(['is_influencer' => $request->is_influencer]);

        // $profile = Profile::find($request->id);

        // $profile->is_influencer = $request->is_influencer;

        // $profile->save();
        
    }

}
