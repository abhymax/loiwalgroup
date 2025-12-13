<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Uom;
use Session;
use Validator;

class UomController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();

        $query = Uom::withCount('product')->orderBy('date_added');

        if ($request->get('uom_name_search') && $request->get('uom_name_search') != '') {
            $query = $query->where('uom_name', 'like', '%'.$request->get('uom_name_search').'%');
        }

        $uomall = $query->get();

        if(COUNT($uomall) > 0){
            $data['uomall'] = $uomall->toArray();
        }
        if($request->ajax()){
            return view('uom/uom_list_ajax', compact('data'));
        }
        else{
            return view('uom/uom_list', compact('data'));
        }
    }

    public function store(Request $request){
        $dataValidation = $request->toArray();
        $errorMessages = [
                'uom_name.required' => 'UOM required',
				'uom_name.unique' => 'Provide unique UOM'
            ];
        $validation = Validator::make($dataValidation, [
                'uom_name' => 'required|unique:uom,uom_name'
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
                $request['date_added'] = date('Y-m-d');
                $uominfo = Uom::create($request->all());
                $data['errorStatus'] = false;
                $data['data'] = $uominfo;
                $data['successmessage'] = 'Successfully Added';
                return $data;
            }
    }

    public function edit($id){
		
        // get the building data
        $uominfo = Uom::where('uom_id',$id)
                        ->first();
        $data['uominfo'] = $uominfo;
        return $data;
    }

    public function update(Request $request, $id){
        $uom_id = $request->uom_id;
        $dataValidation = $request->toArray();
        $errorMessages = [
                'uom_name.required' => 'UOM required',
				'uom_name.unique' => 'Provide unique UOM'
            ];
        $validation = Validator::make($dataValidation, [
                'uom_name' => 'required|unique:uom,uom_name,'.$uom_id.',uom_id'
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
            $uominfo = Uom::findOrFail($uom_id);
            
            $request['date_edited'] = date('Y-m-d');
            $requestData = $request->all();
            
            $uominfo->update($request->all());
            $data['errorStatus'] = false;
            $data['successmessage'] = 'Successfully Updated';
            return $data;
        }
    }

    public function destroy($id){
        $uom = Uom::findOrFail($id);
        $uom->delete();

        $data['errorStatus'] = false;
        return $data;
    }
}