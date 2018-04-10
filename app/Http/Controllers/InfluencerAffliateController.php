<?php

namespace App\Http\Controllers;

use App\InfluencerAffliate;
use Illuminate\Http\Request;

class InfluencerAffliateController extends Controller
{
    public static function createEntryforProfile($profile_id)
    {
        InfluencerAffliate::create([
            'profile_id' => $profile_id,
            'type' => 'influencer'
        ]);

        InfluencerAffliate::create([
            'profile_id' => $profile_id,
            'type' => 'affliate'
        ]);
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InfluencerAffliate  $influencerAffliate
     * @return \Illuminate\Http\Response
     */
    public function show(InfluencerAffliate $influencerAffliate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InfluencerAffliate  $influencerAffliate
     * @return \Illuminate\Http\Response
     */
    public function edit(InfluencerAffliate $influencerAffliate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InfluencerAffliate  $influencerAffliate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfluencerAffliate $influencerAffliate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InfluencerAffliate  $influencerAffliate
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfluencerAffliate $influencerAffliate)
    {
        //
    }
}
