<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CheckAdmin()
    {
    	if(Auth::user()->is_admin == 0){
    		return false;
    	} else {
    		return true;
    	}
    }

    public function index()
    {
    	if(AdminController::CheckAdmin()){
	        return view('adminPanel');
    	} else {
    		return redirect('/');
    	}
    }

    public function getUsers()
    {
        if(AdminController::CheckAdmin()){
            $users = User::all();
            foreach($users as $user){
                if($user->is_admin == 1){
                    $user->is_admin = 'Yes';
                } else {
                    $user->is_admin = 'No';
                }
            }
            return $users;
        }
    }
}
