<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\NoteController;

class WebsiteHelper extends Controller
{
	public static function storeLog($profile_id, $website)
	{
		$note = 'Added website: '.$website;
        return NoteController::createLogNote($profile_id, $note);
	}
	
    public static function updateLog($profile_id, $old_website, $new_website)
    {
        $note = 'Edited website: '.$old_website.' to '.$new_website;
        NoteController::createLogNote($profile_id, $note);
    }
    
    public static function destroyLog($profile_id, $website)
    {
        $note = 'Deleted website: '.$website;
        NoteController::createLogNote($profile_id, $note);
    }
}
