<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use Illuminate\Support\Str;
use Exception;

class GeneralSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generalSettings = GeneralSettings::where('general_settings.id', 1)->first();
        if(empty($generalSettings)){
            $arr = [
                'id' => 1,
                'header_setting_logo' => 'header_setting_logo',
                'footer_setting_logo' => 'footer_setting_logo',
                'footer_setting_about_text' => 'footer_setting_about_text',
                'general_setting_address' => 'general_setting_address',
                'footer_setting_copyright' => 'footer_setting_copyright',
                'general_setting_call_us' => 'general_setting_call_us',
                'general_setting_email_us' => 'general_setting_email_us',
            ];
            $generalSettings = json_decode(json_encode($arr));
        }

        return view('admin.general-settings.list', compact('generalSettings'));
    }


    public function update(Request $request, $id)
    {
        try {
        if ($request->hasFile('header_setting_logo')) {
            $header_setting_logo = $request->file('header_setting_logo');
            $header_setting_logo_name = Str::random(32).'.'.$header_setting_logo->getClientOriginalExtension();
            $destinationPath = public_path('images/general_settings_images');
            $imagePath = $destinationPath. "/".  $header_setting_logo_name;
            $header_setting_logo->move($destinationPath, $header_setting_logo_name);
        }

       if ($request->hasFile('footer_setting_logo')) {
            $footer_setting_logo = $request->file('footer_setting_logo');
            $footer_setting_logo_name = Str::random(32).'.'.$footer_setting_logo->getClientOriginalExtension();
            $destinationPath = public_path('images/general_settings_images');
            $imagePath = $destinationPath. "/".  $footer_setting_logo_name;
            $footer_setting_logo->move($destinationPath, $footer_setting_logo_name);
        }

        $generalSettings = GeneralSettings::find($id);
        if(empty($generalSettings)){
            $generalSettings = new GeneralSettings;
        }
        if($request->hasFile('header_setting_logo') == null){
        }else{ $generalSettings->header_setting_logo = $header_setting_logo_name; }

        if($request->hasFile('footer_setting_logo') == null){
        }else{ $generalSettings->footer_setting_logo = $footer_setting_logo_name; }
        $generalSettings->footer_setting_about_text = $request->footer_setting_about_text;
        $generalSettings->general_setting_address = $request->general_setting_address;
        $generalSettings->footer_setting_copyright = $request->footer_setting_copyright;
        $generalSettings->general_setting_call_us = $request->general_setting_call_us;
        $generalSettings->general_setting_email_us = $request->general_setting_email_us;

        $generalSettings->updated_at = date("Y-m-d H:i:s");
        $generalSettings->save();
        return redirect('admin/dashboard/general-settings')->with('message', 'General Settings Content Updated.');
        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
