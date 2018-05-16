<?php

namespace App\Http\Controllers;

use Auth;
use App\Note;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\CommonHelper;

class NoteController extends Controller
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

    public function addNote(Request $request)
    {
        $date = $request->date_of_action;

        if($request->btnToday)
            $date = now();

        $bool = Note::create([
            'profile_id' => $request->profile_id,
            'author_id' => Auth::id(),
            'note' => $request->note,
            'created_at' => $date
        ]);

        $banner = CommonHelper::createBanner($bool, 'Note', 'add');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public static function createLogNote($profile_id, $note)
    {
        return Note::create([
            'profile_id' => $profile_id,
            'author_id' => Auth::id(),
            'note' => $note,
        ]);
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
