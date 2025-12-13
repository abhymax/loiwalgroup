<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Settings;
use Session;
use Validator;
use Mail;
use App\Helper\Commonhelper;

class SettingsController extends Controller{

    public function get_settings(Request $request){
        $session_data = $request->session()->all();
        $data = Settings::all();
        //print_r($data->first()->toArray());
        return view('settings.settings', compact('data'));
    }

    public function update_settings(Request $request){

        $dataValidation = $request->toArray();
        $errorMessages = [
                'shipment_request_email.required' => 'Email required',
                'delivery_quote_email.required' => 'Email required',
                'contact_email.required' => 'Email required',
                'footer_copyrights.required' => 'Email required'
            ];
        $validation = Validator::make($dataValidation, [
                'shipment_request_email' => 'required',
                'delivery_quote_email' => 'required',
                'contact_email' => 'required',
                'footer_copyrights' => 'required'
            ], $errorMessages);

        if ($validation->fails()) {
            $errors = $validation->messages();
            if (!empty($errors)) {
                $dataError['validation_message'] = $errors->all();
                $dataError['errormessage'] = implode(' ', $errors->all());
                $dataError['errorStatus'] = true;
                return response($dataError);
            }
        }
        else{
            $requestData = $request->all();
            unset($requestData['_token']);

            $settings = Settings::query();
            $settings->update($requestData);
            
            $data['errorStatus'] = false;
            $data['data'] = '';
            $data['successmessage'] = 'Settings updated!';
            return $data;
        }
    }
}
