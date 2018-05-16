<?php

namespace App\Http\Controllers;

use App\Website;
use Illuminate\Http\Request;

use App\Http\Controllers\Helpers\CommonHelper;
use App\Http\Controllers\Helpers\WebsiteHelper;

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
        $this->validate(request(), [
            'profile_id' => 'required',
            'website' => 'required|unique:websites',
        ]);

        $bool = Website::create([
            'profile_id' => $request->profile_id,
            'website' => $request->website,
        ]);

        if($bool){
            WebsiteHelper::storeLog(request('profile_id'), request('website'));
        }

        $banner = CommonHelper::createBanner($bool, 'Website', 'add');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $request->profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public static function staticStore($profile_id ,$website)
    {
        if($profile_id && $website){
            return Website::create([
                'profile_id' => $profile_id,
                'website' => $website
            ]);
        }
    }

    public function edit($id)
    {
        $website = Website::find($id);
        return view('website.editWebsite')->with(['website' => $website]);
    }

    public function update(Request $request)
    {
        $this->validate(request(), [
            'website' => 'required',
        ]);

        $website = Website::find($request->id);
        $old = $website->website;
        $bool = $website->update(['website' => $request->website]);

        if($bool){
            WebsiteHelper::updateLog($website->profile_id, $old, request('website'));
        }

        $banner = CommonHelper::createBanner($bool, 'Website', 'update');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $website->profile_id])->with(['status' => $bool, 'msg' => $msg, 'type' => $type]);
    }

    public function destroy(Request $request)
    {
        $website = Website::find($request->id);
        $deleted = $website->website;
        $deleted_profile_id = $website->profile_id;
        $bool = $website->delete();

        if($bool){
            WebsiteHelper::destroyLog($deleted_profile_id, $deleted);
        }

        $banner = CommonHelper::createBanner($bool, 'Website', 'delete');

        return redirect()->action('ProfileController@viewProfile', ['profile_id' => $website->profile_id])->with(['status' => $bool, 'banner' => $banner]);
    }

    public static function getWebsites($profile_id)
    {
        return Website::where('profile_id', $profile_id)->get();
    }
}
