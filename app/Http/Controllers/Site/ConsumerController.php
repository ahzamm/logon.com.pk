<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\CoreArea;
use App\Models\ZoneArea;
use Validator;
use App\Models\CoverageRequest;
use App\Models\FrontEmail;
class ConsumerController extends Controller
{
    public function index()
    {
        $cities = City::where('active',1)->get();
        return view('site.pages.coverage',compact('cities'));
    }
    public function getCities($id)
    {
        $cities = City::where('active',1)->where('province',$id)->get();
        return response()->json(['cities'=> $cities]);
    }
    public function getcoreAreas($cityId)
    {
        $coreareas = CoreArea::where('active',1)->where('city_id',$cityId)->get();
        return response()->json(['coreareas'=> $coreareas]);
    }
    public function getZoneAreas($id)
    {
        $zoneareas = ZoneArea::where('active',1)->where('core_area_id',$id)->get();
        return response()->json(['zoneareas'=> $zoneareas]);
    }
    public function becomePartner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'landmark' => 'required|string',
            'email'=>'required|email:rfc,dns',
            'mobile_no' => 'required',
            'no_of_users' =>'required',
            'g-recaptcha-response'=> 'required',
            
        ]);
        if ($validator->passes()) {
            $coverageRequest = new CoverageRequest;
            $coverageRequest->name = $request->name;
            $coverageRequest->address = $request->address;
            $coverageRequest->nearest_landmark = $request->landmark;
            $coverageRequest->email = $request->email;
            $coverageRequest->mobile_no = $request->mobile_no;
            $coverageRequest->no_of_users = $request->no_of_users;
            $coverageRequest->request_type = 'partner';
            $coverageRequest->city_id = $request->city_id;
            $coverageRequest->core_area_id = $request->core_area_id;
            $coverageRequest->zone_area_id = $request->zone_area_id;
            
            $frontEmails =  FrontEmail::where('name','consumerpartner')->first();
            if($frontEmails != null)
            {
                try {
                    $coverageRequest->save();
                    $emails = explode(" ",preg_replace("/\r|\n/", "", $frontEmails->emails));
                    $this->sendDetailToManagement(implode(',',$emails),$coverageRequest);
                    $this->sendDetailToUser($coverageRequest->email,$coverageRequest->name,$coverageRequest->request_type);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            return response()->json(['status'=>true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }
    public function becomeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'landmark' => 'required|string',
            'email'=>'required|email:rfc,dns',
            'mobile_no' => 'required',
            'g-recaptcha-response'=> 'required',
        ]);
        if ($validator->passes()) {
            $coverageRequest = new CoverageRequest;
            $coverageRequest->name = $request->name;
            $coverageRequest->address = $request->address;
            $coverageRequest->nearest_landmark = $request->landmark;
            $coverageRequest->email = $request->email;
            $coverageRequest->mobile_no = $request->mobile_no;
            $coverageRequest->no_of_users = $request->no_of_users;
            $coverageRequest->request_type = 'user';
            $coverageRequest->city_id = $request->city_id;
            $coverageRequest->core_area_id = $request->core_area_id;
            $coverageRequest->zone_area_id = $request->zone_area_id;

            $frontEmails =  FrontEmail::where('name','consumeruser')->first();
            if($frontEmails != null)
            {
                try {
                    $coverageRequest->save();
                    $emails = explode(" ",preg_replace("/\r|\n/", "", $frontEmails->emails));
                    $this->sendDetailToManagement(implode(',',$emails),$coverageRequest);
                    $this->sendDetailToUser($coverageRequest->email,$coverageRequest->name,$coverageRequest->request_type);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            return response()->json(['status'=>true]);
        }
        else
        {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }
   

    private function sendDetailToManagement($to,$details)
    {
        $subject = 'Logon Home New Coverage Request for '.ucwords($details->request_type).' | Date: '.date("F j, Y, g:i a");
        // // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: info@logon.com.pk";
        $message = view('email.coverage_request',['details'=>$details])->render();
        mail($to,$subject,$message,$headers);
    }
    private function sendDetailToUser($to,$name,$type)
    {
        $subject = 'Logon Broadband | Thanks for choosing Us';
        // // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: info@logon.com.pk";
        $message = view('email.thanks',['name'=>$name,'type'=>$type])->render();
        mail($to,$subject,$message,$headers);
    }
}
