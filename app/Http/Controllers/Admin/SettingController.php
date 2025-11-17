<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SettingModel;

class SettingController extends Controller
{
    public function settings(){
        $setting = SettingModel::all();          
        return view('admin.setting', compact('setting'));             
    }

    public function submitSettings(Request $request){
        
        try{
            $setting = SettingModel::whereIn('key', ['logo', 'favicon'])
            ->pluck('value', 'key');                                                                   
            $uploadDir = public_path('image/logo/');            
            $data = $request->all();
            unset($data['_token']);

            if($request->hasFile('site_logo')){               
               $siteLogoImg =  fileUploads($request->file('site_logo'), $uploadDir);  
               unset($data['site_logo']);
               if($siteLogoImg !== false){
                  fileDelete($setting['logo'], $uploadDir);
                  $data['logo'] = $siteLogoImg; 
               }
               
            }            
            if($request->hasFile('favicon')){               
               $faviconImg = fileUploads($request->file('favicon'), $uploadDir);
               unset($data['favicon']);
               if($faviconImg !== false){                                    
                  fileDelete($setting['favicon'], $uploadDir);
                  $data['favicon'] = $faviconImg; 
               }
               
            }              
            foreach($data as $key=>$value){
                SettingModel::updateOrCreate(
                    ['key'=>$key],
                    ['value'=>$value]
                );    
            }
            
            $response['status'] = true;
            $response['msg'] = 'Setting successfully update';

        }catch(\Exception $e){
            $response['status'] = false;
            $response['msg'] = $e->getMessage();
        }                        
        return response()->json($response);
    }
}
