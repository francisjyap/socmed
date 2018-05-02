<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\NoteController;
use App\Http\Controllers\SocialMediaTypesController;

class SocialMediaHelper extends Controller
{
	public static function storeLog($username, $profile_id)
    {
        $note = 'Added Social Media Account: '.$username;
        return NoteController::createLogNote($profile_id, $note);
    }
	
	public static function updateLog($old, $new)
	{
		if($old->type != $new->type){
            $note = 'Edited Social Media Account: '.$new->username.' type from '.SocialMediaTypesController::getString($old->type).' to '.SocialMediaTypesController::getString($new->type);
            NoteController::createLogNote($new->profile_id, $note);
        }
        if($old->username != $new->username){
            $note = 'Edited Social Media Account: '.$old->username.' username from '.$old->username.' to '.$new->username;
            NoteController::createLogNote($new->profile_id, $note);
        }
        if($old->url != $new->url){
            $note = 'Edited Social Media Account: '.$new->username.' URL from '.$old->url.' to '.$new->url;
            NoteController::createLogNote($new->profile_id, $note);
        }
        if($old->followers != $new->followers){
            $note = 'Edited Social Media Account: '.$new->username.' followers from '.$old->followers.' to '.$new->followers;
            NoteController::createLogNote($new->profile_id, $note);
        }
	}

	public static function destroyLog($profile_id, $deleted)
	{
		$note = 'Deleted Social Media Account: '.$deleted;
        return NoteController::createLogNote($profile_id, $note);
	}
}
