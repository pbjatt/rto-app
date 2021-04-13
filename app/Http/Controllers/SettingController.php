<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Image;

class SettingController extends Controller
{
    public function edit(Request $request, Setting $setting)
    {
        $setting 	= Setting::find(1);
        $editData =  $setting->toArray();
        $request->replace($editData);
        $request->flash();

        // set page and title ------------------
        $page = 'setting.edit';
        $title = 'Setting';
        $data = compact('page', 'title', 'setting');
        // return data to view

        return view('backend.layout.master', $data);
    }

    
    public function update(Request $request)
    {
        $record     = Setting::find(1);
        $record->title 		= $request->title;
        $record->tagline 	= $request->tagline;
        $record->mobile     = $request->mobile;
        $record->email      = $request->email;
        
        if ($request->hasFile('logo')) {
            $file = $request->logo;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path().'/images/setting/logo/';
            $name = 'logo.png';
            $optimizeImage->save($optimizePath.$name, 72);
            $record->logo = $name;
        }
        if ($request->hasFile('favicon')) {
            $file = $request->favicon;
            $optimizeImage = Image::make($file);
            $optimizeImage->resize(70, 70);
            $optimizePath = public_path().'/images/setting/favicon/';
            $name = 'favicon.png';
            $optimizeImage->save($optimizePath.$name, 72);
            $record->favicon = $name;
        }    
        
        if ($record->save()) {
            return redirect( route('admin.setting') )->with('success', 'Success! Record has been edided');
        }
    }
}
