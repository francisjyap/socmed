<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

namespace App\Http\Controllers;

use App\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Website::all();
    }

    public function create($profile_id)
    {
        return view('website.addWebsite')->with(['profile_id' => $profile_id]);
    }
    
    public function store(Request $request)
    {
        $bool = Website::create([
            'profile_id' => $request->profile_id,
            'website' => $request->website,
        ]);

        if($bool){
            $msg = 'Website created successfully!';
            $type = 'success';
            $note = 'Added website: '.$request->website;
            NoteController::createLogNote($request->profile_id, $note);
        }
        else{
            $msg = 'Website creation failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function edit($id)
    {
        $website = Website::find($id);
        return view('website.editWebsite')->with(['website' => $website]);
    }

    public function update(Request $request)
    {
        $website = Website::find($request->id);
        $old = $website->website;
        $bool = $website->update(['website' => $request->website]);

        if($bool){
            $msg = 'Website updated successfully!';
            $type = 'success';
            $note = 'Edited website: '.$old.' to '.$request->website;
            NoteController::createLogNote($website->profile_id, $note);
        }
        else{
            $msg = 'Website updating failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $website->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function destroy(Request $request)
    {
        $website = Website::find($request->id);
        $deleted = $website->website;
        $deleted_profile_id = $website->profile_id;
        $bool = $website->delete();

        if($bool){
            $msg = 'Website deleted!';
            $type = 'success';
            $note = 'Deleted website: '.$deleted;
            NoteController::createLogNote($deleted_profile_id, $note);
        } else {
            $msg = 'Website failed to delete!';
            $type = 'fail';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $website->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public static function getWebsites($profile_id)
    {
        return Website::where('profile_id', $profile_id)->get();
    }
}
