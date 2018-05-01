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
use App\Http\Controllers\Helpers;
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
        //Validate request
        $this->validate(request(), [
            'profile_id' => 'required',
            'email' => 'required|email|unique:emails'
        ]);

        // Create Email entry
        $bool = Email::create(request(['profile_id', 'email']));

        //Log change
        NoteController::createLogNote(request('profile_id'), 'Added email: '.request('email'));

        //Create banner message
        $banner = Helpers::createBanner($bool, 'Email', 'create');

        //Redirect
        return redirect()->action('ProfileController@viewProfile', ['profile_id' => request('profile_id')])->with(['status' => $bool, 'banner' => $banner]);
    }

    public static function staticStore($profile_id ,$email)
    {
        if($profile_id && $email){
            return Email::create([
                'profile_id' => $profile_id,
                'email' => $email
            ]);
        }
    }

    public function edit($id)
    {
        $email = Email::find($id);
        return view('email.editEmail')->with(['email' => $email]);
    }

    public function update(Request $request)
    {
        $this->validate(request(), [
            'id' => 'required',
            'email' => 'required|email|unique:emails'
        ]);

        $email = Email::find(request('id'));
        $old = $email->email;
        $bool = $email->update(['email' => request('email')]);

        //Log change
        NoteController::createLogNote($email->profile_id, 'Edited email: '.$old.' to '.request('email'));

        //Create banner message
        $banner = Helpers::createBanner($bool, 'Email', 'edit');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $email->profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public function destroy(Request $request)
    {
        $email = Email::find(request('id'));
        $deleted = $email->email;
        $deleted_profile_id = $email->profile_id;
        $bool = $email->delete();

        //Log change
        NoteController::createLogNote($deleted_profile_id, 'Deleted email: '.$deleted);

        //Create banner message
        $banner = Helpers::createBanner($bool, 'Email', 'delete');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $deleted_profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public static function getEmails($profile_id)
    {
        return Email::where('profile_id', $profile_id)->get();
    }
}
