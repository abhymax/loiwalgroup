<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Supplier;
use App\Models\Warehouse;
use Session;
use Validator;
use Product;
use URL;

class SupplierController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();

        $query = Supplier::with('warehouse')->withCount('product')->orderBy('date_added');

        if ($request->get('supplier_number_search') && $request->get('supplier_number_search') != '') {
            $query = $query->where('supplier_number', 'like', '%'.$request->get('supplier_number_search').'%');
        }

        if ($request->get('supplier_name_search') && $request->get('supplier_name_search') != '') {
            $query = $query->where('supplier_name', 'like', '%'.$request->get('supplier_name_search').'%');
        }
		if ($request->get('supplier_email_search') && $request->get('supplier_email_search') != '') {
            $query = $query->where('supplier_email', 'like', '%'.$request->get('supplier_email_search').'%');
        }
		if ($request->get('supplier_mobile_search') && $request->get('supplier_mobile_search') != '') {
            $query = $query->where('supplier_mobile', 'like', '%'.$request->get('supplier_mobile_search').'%');
        }
        if ($request->get('warehouse_id_search') && $request->get('warehouse_id_search') != '') {
            $query = $query->where('warehouse_id', $request->get('warehouse_id_search'));
        }
        $supplier = $query->get();

        if(COUNT($supplier) > 0){
            $data['suppliers'] = $supplier->toArray();
			
        }
		$data['warehouses'] = Warehouse::orderby('warehouse_name')->get();
        if($request->ajax()){
            return view('supplier/supplier_list_ajax', compact('data'));
        }
        else{
            return view('supplier/supplier_list', compact('data'));
        }
    }

    public function store(Request $request){
        $dataValidation = $request->toArray();

        $errorMessages = [
                'supplier_number.required' => 'Supplier Number required',
				'supplier_number.unique' => 'Provide unique number',
                'supplier_name.required' => 'Name required',
                'supplier_email.required' => 'Email required',
				'warehouse_id.required' => 'Warehouse required',
				'supplier_email.email' => 'Provide valid email address',
				'supplier_email.unique' => 'Provide unique email address',
                'supplier_mobile_number.required' => 'Mobile Number required',
				'supplier_mobile_number.unique' => 'Provide unique mobile number',
            ];
        $validation = Validator::make($dataValidation, [
                'supplier_number' => 'required|unique:supplier,supplier_number',
                'supplier_name' => 'required',
				'warehouse_id' => 'required',
                'supplier_email' => 'required|email|unique:supplier,supplier_email',
                'supplier_mobile_number' => 'required|unique:supplier,supplier_mobile_number'
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
               
                $inputs['date_added'] = date('Y-m-d');
                $supplierinfo = Supplier::create($inputs);
                $data['errorStatus'] = false;
                $data['data'] = $supplierinfo;
                $data['successmessage'] = 'Successfully Added';
                return $data;
            }
    }

    public function edit($id){
		
        // get the building data
        $supplierinfo = Supplier::where('supplier_id',$id)
                        ->first();
        
       
        $data['supplierinfo'] = $supplierinfo;
        return $data;
    }

    public function update(Request $request, $id){
        $supplier_id = $request->supplier_id;
        $dataValidation = $request->toArray();
        
        $errorMessages = [
                'supplier_number.required' => 'Supplier Number required',
				'supplier_number.unique' => 'Provide unique number',
                'supplier_name.required' => 'Name required',
                'supplier_email.required' => 'Email required',
				'warehouse_id.required' => 'Warehouse required',
				'supplier_email.email' => 'Provide valid email address',
				'supplier_email.unique' => 'Provide unique email address',
                'supplier_mobile_number.required' => 'Mobile Number required',
				'supplier_mobile_number.unique' => 'Provide unique mobile number',
            ];
        $validation = Validator::make($dataValidation, [
                'supplier_number' => 'required|unique:supplier,supplier_number,'.$supplier_id.',supplier_id',
                'supplier_name' => 'required',
				'warehouse_id' => 'required',
                'supplier_email' => 'required|email|unique:supplier,supplier_email,'.$supplier_id.',supplier_id',
                'supplier_mobile_number' => 'required|unique:supplier,supplier_mobile_number,'.$supplier_id.',supplier_id'
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
            $supplierinfo = Supplier::findOrFail($supplier_id);
			$request['date_edited'] = date('Y-m-d');
            $supplierinfo->update($request->all());
            $data['errorStatus'] = false;
            $data['successmessage'] = 'Successfully Updated';
            return $data;
        }
    }

    public function destroy($id){
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        $data['errorStatus'] = false;
        return $data;
    }
	
	public function checkmobile(Request $request)
	{
		$mobile_number = $request->supplier_mobile_number;
		Supplier::where('supplier_mobile_number',$mobile_number)->get();
		if(COUNT($supplier) > 0){
			echo 'true';
		}	
		else
		{
			echo 'false';
		}
	}
}