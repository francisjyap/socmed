<?php

namespace App\Http\Controllers;

use App\SocialMediaTypes;
use Illuminate\Http\Request;

class SocialMediaTypesController extends Controller
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
}
