<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Adminusers;
use App\Models\Supplier;
use Session;
use Validator;
use URL;

class SubadminController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();

        $query = Adminusers::where('admin_type_id', '!=', 1)->orderBy('admin_id');

        if ($request->get('admin_username_search') && $request->get('admin_username_search') != '') {
            $query = $query->where('admin_username', 'like', '%'.$request->get('admin_username_search').'%');
        }

        $adminusers = $query->get();

        if(COUNT($adminusers) > 0){
            $data['adminusers'] = $adminusers->toArray();
        }
        $data['supplierlist'] = Supplier::all();
        
        if($request->ajax()){
            return view('subadmin/adminusers_list_ajax', compact('data'));
        }
        else{
            return view('subadmin/adminusers_list', compact('data'));
        }
    }

    public function store(Request $request){
        $dataValidation = $request->toArray();
        $errorMessages = [
                'admin_username.required' => 'Username required',
                'admin_password.required' => 'Password required',
                'admin_email.required' => 'Email required'
            ];
        $validation = Validator::make($dataValidation, [
                'admin_username' => 'required',
                'admin_password' => 'required',
                'admin_email' => 'required'
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
				$inputs = $request->all();
                if($request->has('is_active')){
                    $inputs['is_active'] = 'Y';
                }else{
                    $inputs['is_active'] = 'N';
                }

                $inputs['admin_password'] = MD5($inputs['admin_password']);

                $inputs['admin_type_id'] = 0;
                $inputs['date_added'] = date('Y-m-d');
                $adminusersinfo = Adminusers::create($inputs);
                $data['errorStatus'] = false;
                $data['data'] = $adminusersinfo;
                $data['successmessage'] = 'Successfully Added';
                return $data;
            }
    }


    public function edit($id){
		
        // get the building data
        $adminusersinfo = Adminusers::where('admin_id',$id)
                        ->first();
		$data['adminusers'] = $adminusersinfo;
        return $data;
    }


    public function update(Request $request, $id){
        // print_r($_FILES);
        // die();

        $id = $request->admin_id;
        $dataValidation = $request->toArray();
        $errorMessages = [
                'admin_username.required' => 'Username required',
                'admin_email.required' => 'Email required'
            ];
        $validation = Validator::make($dataValidation, [
                'admin_username' => 'required',
                'admin_email' => 'required'
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
            $adminusers_info = Adminusers::findOrFail($id);
            
            $requestData = $request->all();

                if($request->has('is_active')){
                    $requestData['is_active'] = 'Y';
                }else{
                    $requestData['is_active'] = 'N';
                }

            if($requestData['admin_password'] != ''){
                $requestData['admin_password'] = MD5($requestData['admin_password']);
            }else{
                unset($requestData['admin_password']);
            }
            
            $requestData['date_edited'] = date('Y-m-d');
            $adminusers_info->update($requestData);
            $data['errorStatus'] = false;
            $data['successmessage'] = 'Successfully Updated';
            return $data;
        }
    }


    public function destroy($id){
        $adminusers = Adminusers::findOrFail($id);
        $adminusers->delete();

        $data['errorStatus'] = false;
        return $data;
    }

}