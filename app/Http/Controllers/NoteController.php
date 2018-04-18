<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

namespace App\Http\Controllers;

use Auth;
use App\Note;
use App\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function addNote(Request $request)
    {
        $bool = Note::create([
            'profile_id' => $request->profile_id,
            'author_id' => Auth::id(),
            'note' => $request->note,
        ]);

        if($bool){
            $msg = 'Note added successfully!';
            $type = 'success';
        }
        else{
            $msg = 'Note adding failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function getNotes($profile_id)
    {
        $notes = Note::where('profile_id', $profile_id)->get();

        foreach($notes as $note){
            $note->author_id = User::find($note->author_id)->name;
        }

        return $notes;
    }

    public function createInfluencer($profile_id)
    {
        return view('createInfHistory')->with(['profile_id'=>$profile_id]);
    }

    public function createAffliate($profile_id)
    {
        return view('createAffHistory')->with(['profile_id'=>$profile_id]);
    }
}
