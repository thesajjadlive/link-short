<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){

        return view('backend.setting.general');

    }

    public function update(Request $request){

        $this->validate($request,[
            'site_title' =>'required',
            'site_description' =>'required',
            'site_keyword' =>'required',
            'site_address' =>'required',
            'site_phone' =>'required',
            'site_email' =>'required|email',
        ]);
        Setting::updateOrCreate(['name'=>'site_title'],['value'=>$request->get('site_title')]);
        Setting::updateOrCreate(['name'=>'site_description'],['value'=>$request->get('site_description')]);
        Setting::updateOrCreate(['name'=>'site_keyword'],['value'=>$request->get('site_keyword')]);
        Setting::updateOrCreate(['name'=>'site_address'],['value'=>$request->get('site_address')]);
        Setting::updateOrCreate(['name'=>'site_phone'],['value'=>$request->get('site_phone')]);
        Setting::updateOrCreate(['name'=>'site_email'],['value'=>$request->get('site_email')]);
        notify()->success('General Setting Successfully Update','Success');
        return redirect()->back();
    }


    public function appearance()
    {
        return view('backend.setting.appearance');
    }
    public function appearanceUpdate(Request $request)
    {
        $this->validate($request,[
            'site_logo' => 'required|image',
            'site_favicon' => 'required|image',
        ]);
        //Update logo
        if ($request->hasFile('site_logo')){

            $file = $request->file('site_logo');
            $file_name = time().rand(0000,9999).'.'.$file->getClientoriginalExtension();
            if(setting('site_logo')){
                unlink(setting('site_logo'));
            }
            $file->move('uploads/logo/',$file_name);

            Setting::updateOrCreate(
                ['name' => 'site_logo'],
                ['value'=>'uploads/logo/' . $file_name]
            );
        }

        //Update favicon
        if ($request->hasFile('site_favicon')){
            $file = $request->file('site_favicon');
            $file_name = time().rand(0000,9999).'.'.$file->getClientoriginalExtension();
            if(setting('site_favicon')){
                unlink(setting('site_favicon'));
            }
            $file->move('uploads/logo/',$file_name);

            Setting::updateOrCreate(
                ['name' => 'site_favicon'],
                ['value'=>'uploads/logo/' . $file_name]
            );
        }

        notify()->success('Appearance Setting Successfully Update','Success');
        return redirect()->back();

    }


    public function mail()
    {
        return view('backend.setting.mail');
    }

    public function mailUpdate(Request $request)
    {
        $this->validate($request,[
            'mail_mailer' =>'string|max:255',
            'mail_host' =>'nullable|string|max:255',
            'mail_port' =>'nullable|string|max:255',
            'mail_username' =>'nullable|string|max:255',
            'mail_password' =>'nullable|string|max:255',
            'mail_encryption' =>'nullable|string|max:255',
            'mail_from_address' =>'nullable|string|max:255',
            'mail_from_name' =>'nullable|string|max:255',
        ]);

        Setting::updateOrCreate(['name' =>'mail_mailer'],['value'=>$request->get('mail_mailer')]);
        Artisan::call("env:set MAIL_MAILER='".$request->get('mail_mailer')."'");

        Setting::updateOrCreate(['name' =>'mail_host'],['value'=>$request->get('mail_host')]);
        Artisan::call("env:set MAIL_HOST='".$request->get('mail_host')."'");

        Setting::updateOrCreate(['name' =>'mail_port'],['value'=>$request->get('mail_port')]);
        Artisan::call("env:set MAIL_PORT='".$request->get('mail_port')."'");

        Setting::updateOrCreate(['name' =>'mail_username'],['value'=>$request->get('mail_username')]);
        Artisan::call("env:set MAIL_USERNAME='".$request->get('mail_username')."'");

        Setting::updateOrCreate(['name' =>'mail_password'],['value'=>$request->get('mail_password')]);
        Artisan::call("env:set MAIL_PASSWORD='".$request->get('mail_password')."'");

        Setting::updateOrCreate(['name' =>'mail_encryption'],['value'=>$request->get('mail_encryption')]);
        Artisan::call("env:set MAIL_ENCRYPTION='".$request->get('mail_encryption')."'");

        Setting::updateOrCreate(['name' =>'mail_from_address'],['value'=>$request->get('mail_from_address')]);
        Artisan::call("env:set MAIL_FROM_ADDRESS='".$request->get('mail_from_address')."'");

        Setting::updateOrCreate(['name' =>'mail_from_name'],['value'=>$request->get('mail_from_name')]);
        Artisan::call("env:set MAIL_FROM_NAME='".$request->get('mail_from_name')."'");

        notify()->success('Mail Setting Successfully Update','Success');
        return redirect()->back();
    }


    public function privacy()
    {
        return view('backend.setting.privacy');
    }
    public function privacyUpdate(Request $request)
    {
        $this->validate($request,[
            'site_privacy' => 'required',
        ]);
        Setting::updateOrCreate(['name'=>'site_privacy'],['value'=>$request->get('site_privacy')]);

        notify()->success('Privacy Policy Successfully Updated','Success');
        return redirect()->back();
    }


    public function term()
    {
        return view('backend.setting.term');
    }
    public function termUpdate(Request $request)
    {
        $this->validate($request,[
            'site_term' => 'required',
        ]);
        Setting::updateOrCreate(['name'=>'site_term'],['value'=>$request->get('site_term')]);

        notify()->success('Term of Use Successfully Updated','Success');
        return redirect()->back();
    }

    public function about()
    {
        return view('backend.setting.about');
    }
    public function aboutUpdate(Request $request)
    {
        $this->validate($request,[
            'site_about' => 'required',
        ]);
        Setting::updateOrCreate(['name'=>'site_about'],['value'=>$request->get('site_about')]);

        notify()->success('About Successfully Updated','Success');
        return redirect()->back();
    }


}
