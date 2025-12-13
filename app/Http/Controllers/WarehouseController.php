<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Warehouse;
use App\Models\Warehousecontact;
use App\Models\Supplier;
use Session;
use Validator;

class WarehouseController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();

        $query = Warehouse::withCount('supplier')->orderBy('date_added');

        if ($request->get('warehouse_name_search') && $request->get('warehouse_name_search') != '') {
            $query = $query->where('warehouse_name', 'like', '%'.$request->get('warehouse_name_search').'%');
        }

        if ($request->get('warehouse_email_search') && $request->get('warehouse_email_search') != '') {
            $query = $query->where('warehouse_email', 'like', '%'.$request->get('warehouse_email_search').'%');
        }

        if ($request->get('warehouse_contact_number_search') && $request->get('warehouse_contact_number_search') != '') {
            $query = $query->where('warehouse_contact_number', 'like', '%'.$request->get('warehouse_contact_number_search').'%');
        }

        $warehouses = $query->get();

        if(COUNT($warehouses) > 0){
            $data['warehouses'] = $warehouses->toArray();
        }
		/*$contactinfo[0]['contact_no'] = '';
        $contactinfo[0]['contact_email'] = '';
       
        $data['contactinfo'] = $contactinfo;
		$data['block_count'] = 1;*/
        if($request->ajax()){
            return view('warehouse/warehouse_list_ajax', compact('data'));
        }
        else{
            return view('warehouse/warehouse_list', compact('data'));
        }
    }
    public function warehouseadd(){
        
		
		$contactinfo[0]['warehouse_contact_no'] = '';
		$contactinfo[0]['warehouse_contact_email'] = '';
		$contactinfo[0]['warehouse_contact_id'] = '';
        $datacontact['contactinfo'] = $contactinfo;
		$datacontact['block_count'] = 1;

		
		$datawarehouse['contact_details'] = view('warehouse/warehouse_contact_details', compact('datacontact'))->render();
        
        return $datawarehouse;
        
    }
    public function store(Request $request){
        $dataValidation = $request->toArray();
        $errorMessages = [
                'warehouse_name.required' => 'Warehouse Name required',
                'warehouse_contact_person.required' => 'Contact Person required',
				'warehouse_contact_number.required' => 'Contact Number required'
            ];
        $validation = Validator::make($dataValidation, [
                'warehouse_name' => 'required',
                'warehouse_contact_person' => 'required',
				'warehouse_contact_number' => 'required'
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
                $warehouseinfo = Warehouse::create($request->all());
                $data['errorStatus'] = false;
                $data['data'] = $warehouseinfo;
				if($request['block_count']!=0)
				{
					for($i=0;$i<$request['block_count'];$i++)
					{
						if($request['contact_email_'.$i]!='' && $request['contact_no_'.$i]!=''){
							$contactinfo = array();
							$contactinfo['warehouse_id'] = $warehouseinfo->warehouse_id;
							$contactinfo['warehouse_contact_email'] = $request['contact_email_'.$i];
							$contactinfo['warehouse_contact_no'] = $request['contact_no_'.$i];
							Warehousecontact::create($contactinfo);
						}
					}
				}
                $data['successmessage'] = 'Successfully Added';
                return $data;
            }
    }

    public function edit($id){
		
        // get the building data
        $warehouseinfo = Warehouse::where('warehouse_id',$id)
                        ->first();
		$warehouse_contact = Warehousecontact::where('warehouse_id',$id)->get();
       
        if(count($warehouse_contact) == 0)
        {
            $contactinfo[0]['warehouse_contact_no'] = '';
			$contactinfo[0]['warehouse_contact_email'] = '';
			$contactinfo[0]['warehouse_contact_id'] = '';
            $datacontact['block_count']=1;
            
        } else {
            $datacontact['block_count'] = count($warehouse_contact);
            $contactinfo = $warehouse_contact->toArray();
            
        }
		$datacontact['contactinfo'] = $contactinfo;
        $data['warehouseinfo'] = $warehouseinfo;
		$data['contact_details'] = view('warehouse/warehouse_contact_details', compact('datacontact'))->render();
        return $data;
    }

    public function update(Request $request, $id){
        $warehouse_id = $request->warehouse_id;
        $dataValidation = $request->toArray();
        $errorMessages = [
                'warehouse_name.required' => 'Warehouse Name required',
                'warehouse_contact_person.required' => 'Contact Person required',
				'warehouse_contact_number.required' => 'Contact Number required'
            ];
        $validation = Validator::make($dataValidation, [
                'warehouse_name' => 'required',
                'warehouse_contact_person' => 'required',
				'warehouse_contact_number' => 'required'
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
            $warehouseinfo = Warehouse::findOrFail($warehouse_id);
            $views = array();
            $modify = array();
            $delete = array();
            $permission = array();
            $request['date_edited'] = date('Y-m-d');
            $requestData = $request->all();
            if(isset($requestData['module_check']) && !empty($requestData['module_check'])){
                foreach($requestData['module_check'] as $module_id=>$permissions){
                    if(isset($permissions['can_view']) && $permissions['can_view'] == 1){
                        array_push($views, $module_id);
                    }
                    if(isset($permissions['can_modify']) && $permissions['can_modify'] == 1){
                        array_push($modify, $module_id);
                    }
                    if(isset($permissions['can_delete']) && $permissions['can_delete'] == 1){
                        array_push($delete, $module_id);
                    }
                }
            }
            $permission['can_view'] = $views;
            $permission['can_modify'] = $modify;
            $permission['can_delete'] = $delete;
            $request['permission'] = serialize($permission);
            $warehouseinfo->update($request->all());
			if($requestData['block_count']!=0)
			{
				$wcontactemail = $requestData['contact_email'];
				$wcontactno = $requestData['contact_no'];
				$wcontactid = $requestData['warehouse_contact_id'];
				for($i=0;$i<$requestData['block_count'];$i++)
				{
					//if($requestData['contact_email_'.$i]!='' && $requestData['contact_no_'.$i]!=''){
					if($wcontactemail[$i]!='' && $wcontactno[$i]!=''){
						$contactinfo = array();
						$contactinfo['warehouse_id'] = $warehouse_id;
						$contactinfo['warehouse_contact_email'] = $wcontactemail[$i];
						$contactinfo['warehouse_contact_no'] = $wcontactno[$i];
						if($wcontactid[$i]==''){
							Warehousecontact::create($contactinfo);
						} else {
							$contactentry = Warehousecontact::findOrFail($wcontactid[$i]);
							
							$contactentry->update($contactinfo);
						}
					}
				}
			}
            $data['errorStatus'] = false;
            $data['successmessage'] = 'Successfully Updated';
            return $data;
        }
    }

    public function destroy($id){
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();

        $data['errorStatus'] = false;
        return $data;
    }
	public function getsupplier($id){
        $supplierinfo = Supplier::where('warehouse_id',$id)->get();
		$data['suppliers'] = $supplierinfo->toArray();
		return view('warehouse/supplier_list', compact('data'));
    }
	public function delcontact($id){
		$contactinfo = Warehousecontact::findOrFail($id);
        $contactinfo->delete();
		$data['errorStatus'] = false;
        return $data;
	}
}