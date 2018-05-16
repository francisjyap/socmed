<?php

namespace App\Http\Controllers;

use App\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Helpers\LogHelper;
use App\Http\Controllers\Helpers\CommonHelper;

class LogController extends Controller
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

    public static function createLog($user_id, $profile_id, $class, $field_name, $field_data)
    {
        return Log::create([
            'user_id' => $user_id,
            'profile_id' => $profile_id,
            'type' => $class,
            'field_name' => $field_name,
            'field_data' => $field_data
        ]);
    }

    public function createHistory(Request $request)
    {
        $bool = Log::create(request(['user_id', 'profile_id', 'type', 'field_name', 'field_data', 'created_at']));

        $banner = CommonHelper::createBanner($bool, 'History', 'create');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => request('profile_id')])->with(['status' => $bool, 'banner' => $banner]);
    }

    public static function getInfHistory($profile_id)
    {
        $logs = Log::where('profile_id', $profile_id)->where('type', 0)->get();

        $logs = LogHelper::convertFieldDataToString($logs);

        $logs = $logs->sortByDesc('created_at');

        return $logs;
    }

    public static function getAffHistory($profile_id)
    {
        $logs = Log::where('profile_id', $profile_id)->where('type', 1)->get();

        $logs = LogHelper::convertFieldDataToString($logs);

        $logs = $logs->sortByDesc('created_at');

        return $logs;
    }

    public static function getHistory($profile_id, $type)
    {
        $logs = Log::where('profile_id', $profile_id)->where('type', $type)->get();

        $logs = LogHelper::convertFieldDataToString($logs);

        return $logs;
    }

    public function editHistory($log_id)
    {
        $log = Log::find($log_id);

        return view('editHistory')->with([
            'log' => $log,
        ]);
    }

    public function updateHistory(Request $request)
    {
        $log = Log::find($request->id);

        $bool = $log->update(['created_at' => $request->date]);

        if($bool){
            $msg = 'History date edited successfully!';
            $type = 'success';
        }
        else{
            $msg = 'History date editing failed!';
            $type = 'danger';
        }

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $log->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }
}
