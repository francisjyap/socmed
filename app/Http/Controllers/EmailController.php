<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Email::all();
    }

    public function create($profile_id)
    {
        return view('email.addEmail')->with(['profile_id' => $profile_id]);
    }

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

        $note = 'Added email: '.$request->email;
        NoteController::createLogNote($request->profile_id, $note);

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function edit($id)
    {
        $email = Email::find($id);
        return view('email.editEmail')->with(['email' => $email]);
    }

    public function update(Request $request)
    {
        $email = Email::find($request->id);
        $old = $email->email;
        $bool = $email->update(['email' => $request->email]);

        if($bool){
            $msg = 'Email updated successfully!';
            $type = 'success';
            $note = 'Edited email: '.$old.' to '.$request->email;
            NoteController::createLogNote($email->profile_id, $note);
        }
        else{
            $msg = 'Email updating failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $email->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function destroy(Request $request)
    {
        $email = Email::find($request->id);
        $deleted = $email->email;
        $deleted_profile_id = $email->profile_id;
        $bool = $email->delete();

        if($bool){
            $msg = 'Email deleted!';
            $type = 'success';
            $note = 'Deleted email: '.$deleted;
            NoteController::createLogNote($deleted_profile_id, $note);
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
