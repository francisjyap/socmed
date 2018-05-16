<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

use App\Http\Controllers\Helpers\CommonHelper;

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
        $this->validate(request(), [
            'profile_id' => 'required',
            'email' => 'required|email|unique:emails'
        ]);

        $bool = Email::create(request(['profile_id', 'email']));

        NoteController::createLogNote(request('profile_id'), 'Added email: '.request('email'));

        $banner = CommonHelper::createBanner($bool, 'Email', 'create');

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
            'email' => 'required|email'
        ]);

        $email = Email::find(request('id'));
        $old = $email->email;
        $bool = $email->update(['email' => request('email')]);

        NoteController::createLogNote($email->profile_id, 'Edited email: '.$old.' to '.request('email'));

        $banner = CommonHelper::createBanner($bool, 'Email', 'edit');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $email->profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public function destroy(Request $request)
    {
        $email = Email::find(request('id'));
        $deleted = $email->email;
        $deleted_profile_id = $email->profile_id;
        $bool = $email->delete();

        NoteController::createLogNote($deleted_profile_id, 'Deleted email: '.$deleted);

        $banner = CommonHelper::createBanner($bool, 'Email', 'delete');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $deleted_profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public static function getEmails($profile_id)
    {
        return Email::where('profile_id', $profile_id)->get();
    }
}
