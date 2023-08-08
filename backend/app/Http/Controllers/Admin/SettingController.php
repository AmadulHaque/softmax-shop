<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use DB;
class SettingController extends Controller
{
    public function Index()
    {
        return view('pages.Setting.Index');
    }

    public function settingUpdate(Request $request)
    {
        $dd =DB::table('settings')->first();
        $data = array();
        if ($request->file('logo')) {
            $filename =  uploadSingleImage($request->file('logo') ,'setting',$dd->logo);
            $data['logo'] =  $filename;
        }
        if ($request->file('favicon')) {
            $filename =  uploadSingleImage($request->file('favicon') ,'setting', $dd->favicon);
            $data['favicon'] =  $filename;
        }
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['wp_phone'] = $request->wp_phone;
        $data['fb_page'] = $request->fb_page;
        $data['fb_group'] = $request->fb_group;
        $data['youtube'] = $request->youtube;
        $data['shop_title'] = $request->shop_title;
        $data['address'] = $request->address;
        $data['address_two'] = $request->address_two;
        $data['currency'] = $request->currency;
        DB::table('settings')->update($data);
        $notification = array('message' => 'Update Success!','alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
