<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Supplier;
use App\Models\District;
use App\Models\Stocktransfer;
use App\Models\Stocktransfermaterial;
use App\Models\Logentry;
use App\Models\Stockavailable;
use App\Models\Product;
use Session;
use Validator;

use URL;

class StocktransferController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();

        $query = Stocktransfer::with('supplier')->orderBy('date_added');

        if ($request->get('invoice_number_search') && $request->get('invoice_number_search') != '') {
            $query = $query->where('invoice_number', 'like', '%'.$request->get('invoice_number_search').'%');
        }

        if ($request->get('supplier_id_search') && $request->get('supplier_id_search') != '') {
            $query = $query->where('supplier_id', $request->get('supplier_id_search'));
        }
		if ($request->get('from_date') && $request->get('from_date') != '') {
            $query = $query->where('invoice_date','>=', $request->get('from_date'));
        }
        if ($request->get('to_date') && $request->get('to_date') != '') {
            $query = $query->where('invoice_date','<=', $request->get('to_date'));
        }
        $stocktransfer = $query->get();

        if(COUNT($stocktransfer) > 0){
            $data['stocktransfers'] = $stocktransfer->toArray();
			
        }
		$data['suppliers'] = Supplier::orderby('supplier_name')->get();
		
        if($request->ajax()){
            return view('stocktransfer/list_ajax', compact('data'));
        }
        else{
            return view('stocktransfer/list', compact('data'));
        }
    }
	public function add()
	{
		$data['suppliers'] = Supplier::orderby('supplier_name')->get();
		$podinfo[0]['product_id'] = '';
        $podinfo[0]['product_sku'] = '';
        $podinfo[0]['batch_no'] = '';
        $podinfo[0]['qty'] = '';
        $podinfo[0]['rate'] = '';
        $podinfo[0]['amount'] = '';
        $podinfo[0]['material_id'] = '';
        $data['podinfo'] = $podinfo;
		$data['block_count'] = 1;
		
		return view('stocktransfer/transfer_add', compact('data'));
	}
    
	public function getproduct($id){
		$products = Stockavailable::where('supplier_id', $id)->with('product')->groupBy('product_id')->get();
		$phtml='<option value="">Select</option>';
		
        foreach($products as $product)
		{
		   $phtml.='<option value="'.$product->product_id.'" prodsku="'.$product->product_sku.'">'.$product['product']->product_name.'</option>';
		}
		return $phtml;
        
    }
	
	public function getstock($id){
		$stocks = Stockavailable::where('product_id', $id)->orderBy('batch_no')->get();
		$phtml='<option value="">Select</option>';
        foreach($stocks as $stock)
		{
		   $phtml.='<option value="'.$stock->batch_no.'" available="'.$stock->available_qty.'">'.$stock->batch_no.'</option>';
		}
		return $phtml;
		
	}
	
    public function store(Request $request){
        $dataValidation = $request->toArray();

        $errorMessages = [
                'party_name.required' => 'Party name required',
				'supplier_id.unique' => 'Supplier required',
                'destination.required' => 'Destination required',
                'invoice_number.required' => 'Invoice Number required',
				'invoice_date.unique' => 'Invoice date required',
                'transport.required' => 'Transport required',
                'dispatch_date.required' => 'Dispatch date required',
                'delivery_date.required' => 'Delivery date required',
				
            ];
        $validation = Validator::make($dataValidation, [
                'invoice_number' => 'required|unique:invoice_out,invoice_number',
                'party_name' => 'required',
				'destination' => 'required',
                'supplier_id' => 'required',
				'invoice_date' => 'required',
                'transport' => 'required',
				'dispatch_date' => 'required',
                'delivery_date' => 'required'
           
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
                $invinfo = Stocktransfer::create($inputs);
				if($request['block_count']!=0)
				{
					for($i=0;$i<$request['block_count'];$i++)
					{
						if($request['product_id_'.$i]!='' && $request['qty_'.$i]!=''){
							$pinfo = Product::where('product_id',$request['product_id_'.$i])
									->first();
							
							$podinfo = array();
							$podinfo['stock_transfer_id'] = $invinfo->stock_transfer_id;
							$podinfo['product_id'] = $request['product_id_'.$i];
							$podinfo['product_name'] = $pinfo->product_name;
							$podinfo['product_sku'] = $request['product_sku_'.$i];
							$podinfo['batch_no'] = $request['batch_no_'.$i];
							$podinfo['qty'] = $request['qty_'.$i];
							$podinfo['rate'] = $request['rate_'.$i];
							$podinfo['amount'] = $request['amount_'.$i];
							Stocktransfermaterial::create($podinfo);
							
							$logentry = array();
							$logentry['supplier_id'] = $inputs['supplier_id'];
							$logentry['product_id'] = $request['product_id_'.$i];
							$logentry['batch_no'] = $request['batch_no_'.$i];
							$logentry['log_type'] = 'O';
							$logentry['log_details'] = 'Stock Transfer';
							$logentry['qty'] = $request['qty_'.$i];
							$logentry['entry_date'] = $inputs['invoice_date'];
							$logentry['created_at'] = $inputs['date_added'];
							
							Logentry::create($logentry);
							
							$available = Stockavailable::where('supplier_id', $inputs['supplier_id'])
							            ->where('product_id',$request['product_id_'.$i])
                                        ->where('batch_no',$request['batch_no_'.$i]) 										
							            ->first();
							if($available)
							{
								$total_qty = $available->available_qty - $podinfo['qty'];
								$stockinfo = Stockavailable::findOrFail($available->id);
								$entry['available_qty'] = $total_qty;
								$stockinfo->update($entry);
							} 
						}
					}
				}
				
                $data['errorStatus'] = false;
               // $data['data'] = $supplierinfo;
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
	public function view($id){
		
        // get the building data
        $invoiceinfo = Stocktransfer::with('supplier')->where('stock_transfer_id',$id)
                        ->first();
        
        $materialinfo = Stocktransfermaterial::with('product')->where('stock_transfer_id',$id)->get();
        if(count($materialinfo) == 0)
        {
            $podinfo[0]['product_id'] = '';
			$podinfo[0]['product_sku'] = '';
			$podinfo[0]['batch_no'] = '';
			$podinfo[0]['qty'] = '';
			$podinfo[0]['rate'] = '';
			$podinfo[0]['amount'] = '';
			$podinfo[0]['material_id'] = '';
            $datapod['block_count']=1;
            //$data['total_ship'] = 0;
        } else {
            $data['block_count'] = count($materialinfo);
            //$podinfo = $inventory_pod->toArray();
            
           
        }
		$data['podinfo'] = $materialinfo;
        $data['invoiceinfo'] = $invoiceinfo;
		return view('stocktransfer/transfer_view', compact('data'));
		//$datafile['inventory_files'] = Inventoryfile::where('inv_id',$id)->get();
		//$data['pod_details'] = view('backend/inventories/inventory_pod_details', compact('datapod'))->render();
		//$data['file_upload'] = view('backend/inventories/inventory_file_upload', compact('datafile'))->render();
        //return $data;
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

   
	
}