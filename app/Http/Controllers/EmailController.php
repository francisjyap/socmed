<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
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
        return Email::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($profile_id)
    {
        return view('profiles.addEmail')->with(['profile_id' => $profile_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bool = Email::create([
            'profile_id' => $request->profile_id,
            'email' => $request->email,
        ]);

        if($bool){
            $msg = 'Email created successfully!';
            $type = 'success';
        }
        else{
            $msg = 'Email creation failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = Email::find($id);
        return view('profiles.editEmail')->with(['email' => $email]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $email = Email::find($request->id);

        $bool = $email->update(['email' => $request->email]);

        if($bool){
            $msg = 'Email updated successfully!';
            $type = 'success';
        }
        else{
            $msg = 'Email updating failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $email->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $email = Email::find($request->id);
        $bool = $email->delete();

        if($bool){
            $msg = 'Email deleted!';
            $type = 'success';
        } else {
            $msg = 'Email failed to delete!';
            $type = 'fail';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $email->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public static function getEmails($profile_id)
    {
        return Email::where('profile_id', $profile_id)->get();
    }
}
