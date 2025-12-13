<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Admin;
use Session;
use Validator;
use Mail;
use App\Helper\Commonhelper;

class AdminUserController extends Controller{

    public function logintemplate(Request $request){
        $data = $request->session()->all();
        if(isset($data['admin_id']) && $data['admin_id'] != ''){
            return redirect('dashboard');
        }
        else{
            return view('login/login');
        }
    }

    public function login(Request $request){
        $data = array();
        try{
            $dataValidation = $request->toArray();
            $errorMessages = [
                    'username.required' => 'Enter Username, ',
                    'password.required' => 'Enter Password',
                ];
            $validation = Validator::make($dataValidation, [
                    'username' => 'required',
                    'password' => 'required'
                ], $errorMessages);

            if ($validation->fails()) {
                $errors = $validation->messages();
                if (!empty($errors)) {
                    $dataError['validation_message'] = $errors->all();
                    $dataError['errormessage'] = implode(' ', $errors->all());
                    $dataError['errorStatus'] = true;
                    return response($dataError);
                }
            } else {

                $user_data = array(
                    'admin_username' => $request->username,
                    'admin_password' => MD5($request->password)
                );
				
                $admin = Admin::where($user_data)->first();
                if(!empty($admin)){

                    $admin_details = $admin->toArray();
                    Session::put('admin_id', $admin_details['admin_id']);
                    Session::put('email', $admin_details['admin_email']);
                    if($admin_details['admin_type_id'] == 1){
						Session::put('is_admin', 'Y');
					} else {
						Session::put('is_admin', 'N');
					}
                    $data['errorStatus'] = false;
                }
                else{

                    $data['errorStatus'] = true;
                    $data['errormessage'] = 'Invalid Username/Password';
                }
                return $data;
            }
        }
        catch (\Illuminate\Database\QueryException $e) {
            $error = array('errorStatus' => true, 'errormessage' => 'QueryException');
            return response($error);
        } catch (\Exception $e) {
            $error = array('errorStatus' => true, 'errormessage' => 'Exception');
            return response($error);
        }
    }

    public function logout(){
        $data = array();
        try{
            Session::flush();
            return redirect('/login');
        } catch (\Exception $e) {
            $error = array('errorStatus' => true, 'errormessage' => 'Exception');
            return response($error);
        }
    }

    public function forgot_password(Request $request){
        $data = $request->session()->all();
        if(isset($data['user_id']) && $data['user_id'] != ''){
            return redirect('dashboard');
        }
        else{
            return view('login/forgotpassword');
        }
    }

    public function reset(Request $request){
        $data = array();
        $password_auth = hash_hmac('sha256', str_random(20), config('app.key'));
        $user = User::where(array('email' => $request->email))->first();
        if(!empty($user) > 0){
            $user->update(['password_auth' => $password_auth]);
            $verify_link = '<a href="' . url("/") . '/password/reset/' . $password_auth . '/' . $request->email . '">click here</a>';
            $emailText = '<p>Please [VERIFY_LINK] to reset your password. </p>';
            $emailText = str_replace('[VERIFY_LINK]', $verify_link, $emailText);
            $userinfo = User::where(array('email' => $request->email))->first();
            $emaildata = array();
            $emaildata['name'] = $userinfo->first_name;
            $emaildata['body'] = $emailText;
            $emaildata['email'] = $request->email;

            $subjectText = 'Reset Your Password';
            $emaildata['subject'] = $subjectText;

            Mail::send('emails.email_template_forgot_password', ['emaildata' => $emaildata], function ($message) use ($emaildata) {
                $toEmail = $emaildata['email'];
                $message->to($toEmail)->subject($emaildata['subject']);
            });
            $data['errorStatus'] = false;
            $data['successmessage'] = 'Email sent successfully';
        }
        else{
            $data['errorStatus'] = true;
            $data['errormessage'] = 'You are not registered with us';
        }
        return $data;
    }

    public function showResetForm($token, $email){
        $where = array('email' => $email, 'password_auth' => $token);
        $user = User::where($where)->first();
        $data = array();
        if ($user) {
            $data['token'] = $token;
            $data['email'] = $email;
            return view('login.resetpassword', compact('data'));
        } else {
            $data['error_code'] = '403';
            $data['error_message'] = 'Invalid authentication. Please regenerate password reset link.';
            $data['button_text'] = 'Login';
            $data['button_url'] = url('/'). '/login';
            return view('errors.404dynamic', compact('data'));
        }
    }

    public function reset_password(Request $request){
        $user_where = array(
            'email' => $request->email,
            'password_auth' => $request->token
        );
        $user = User::where($user_where)->first();
        if(!empty($user)){
            $user_update_array['password_auth'] = '';
            $user_update_array['password'] = MD5($request->password);
            $user->update($user_update_array);
            $data['errorStatus'] = false;
            $data['successmessage'] = 'Password changed';
        }
        else{
            $data['errorStatus'] = true;
            $data['errormessage'] = 'Something went wrong!';
        }
        return $data;
    }

    public function get_profile(Request $request){
        $session_data = $request->session()->all();
        $admin_id = $session_data['admin_id'];
        $admin_where = array('admin_id' => $admin_id);
        $data = Admin::where($admin_where)->first();
        
        return view('profile.profile', compact('data'));
    }

    public function update_profile(Request $request){
        $session_data = $request->session()->all();
        $admin_id = $session_data['admin_id'];
        $dataValidation = $request->toArray();
        $errorMessages = [
                'admin_email.required' => 'Email required, ',
                'admin_username.required' => 'Username required',
                
            ];
        $validation = Validator::make($dataValidation, [
                'admin_email' => 'required',
                'admin_username' => 'required',
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
            if(isset($requestData['password']) && $requestData['password'] != '' && isset($requestData['password_confirm']) && $requestData['password_confirm'] != ''){
                if($requestData['password'] == $requestData['password_confirm']){
                    $requestData['admin_password'] = MD5($requestData['password_confirm']);
                }
                else{
                    $error_msg = 'Password and Confirm password must be same';
                    $dataError['errormessage'] = $error_msg;
                    $dataError['errorStatus'] = true;
                    return response($dataError);
                }
            }

            $admin = Admin::findOrFail($admin_id);
            $admin->update($requestData);
            
           
            $admin_where = array('admin_id'=> $admin_id);
            $admin_select_fields = array('admin_id', 'admin_email', 'admin_username');
            $admininfo = Admin::select($admin_select_fields)->where($admin_where)->first();
            
            $data['errorStatus'] = false;
            $data['data'] = $admininfo;
            $data['successmessage'] = 'Profile updated!';
            return $data;
        }
    }
}
