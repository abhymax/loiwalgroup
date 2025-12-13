<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Uom;
use Session;
use Validator;

class ProductController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();

        $query = Product::with('supplier')->orderBy('date_added');

        if ($request->get('product_name_search') && $request->get('product_name_search') != '') {
            $query = $query->where('product_name', 'like', '%'.$request->get('product_name_search').'%');
        }
		if ($request->get('product_sku_search') && $request->get('product_sku_search') != '') {
            $query = $query->where('product_sku', 'like', '%'.$request->get('product_sku_search').'%');
        }
		
		if ($request->get('supplier_id_search') && $request->get('supplier_id_search') != '') {
            $query = $query->where('supplier_id', $request->get('supplier_id_search'));
        }

        $products = $query->get();

        if(COUNT($products) > 0){
            $data['products'] = $products->toArray();
			
        }
		$data['suppliers'] = Supplier::orderby('supplier_name')->get();
		
        if($request->ajax()){
            return view('product/product_list_ajax', compact('data'));
        }
        else{
            return view('product/product_list', compact('data'));
        }
    }
    public function addproductform(){
        
        $data['suppliers'] = Supplier::orderby('supplier_name')->get();
        $data['categories'] = Category::orderby('category_name')->get();
        $data['uomall'] = Uom::orderby('uom_name')->get();
        
        $dataproduct['add_product'] = view('product/add_product', compact('data'))->render();
        
        return $dataproduct;
        
    }
    public function store(Request $request){
        $dataValidation = $request->toArray();
        $errorMessages = [
                'category_id.required' => 'Category required',
				'supplier_id.required' => 'Supplier required',
				'uom_id.required' => 'UOM required',
				'product_name.required' => 'Product name required',
				'product_sku.unique' => 'Provide unique SKU',
				'product_sku.required' => 'Product SKU required'
            ];
        $validation = Validator::make($dataValidation, [
		        'category_id' => 'required',
				'supplier_id' => 'required',
				'uom_id' => 'required',
				'product_name' => 'required',
				'product_sku' => 'required|unique:product,product_sku'
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
                $productinfo = Product::create($request->all());
                $data['errorStatus'] = false;
                $data['data'] = $productinfo;
                $data['successmessage'] = 'Successfully Added';
                return $data;
            }
    }

    public function edit($id){
		
        // get the building data
        $productinfo = Product::where('product_id',$id)
                        ->first();
        $data['productinfo'] = $productinfo;
		$data['suppliers'] = Supplier::orderby('supplier_name')->get();
        $data['categories'] = Category::orderby('category_name')->get();
        $data['uomall'] = Uom::orderby('uom_name')->get();
        $dataproduct['edit_product'] = view('product/edit_product', compact('data'))->render();
        
        return $dataproduct;
    }

    public function update(Request $request, $id){
        $product_id = $request->product_id;
        $dataValidation = $request->toArray();
        $errorMessages = [
                /*'category_id.required' => 'Category required',
				'supplier_id.required' => 'Supplier required',
				'uom_id.required' => 'UOM required',*/
				'product_name.required' => 'Product name required',
				'product_sku.unique' => 'Provide unique SKU',
				'product_sku.required' => 'Product SKU required'
            ];
        $validation = Validator::make($dataValidation, [
		        /*'category_id' => 'required',
				'supplier_id' => 'required',
				'uom_id' => 'required',*/
				'product_name' => 'required',
                'product_sku' => 'required|unique:product,product_sku,'.$product_id.',product_id'
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
            $productinfo = Product::findOrFail($product_id);
            
            $request['date_edited'] = date('Y-m-d');
            $requestData = $request->all();
            
            $productinfo->update($request->all());
            $data['errorStatus'] = false;
            $data['successmessage'] = 'Successfully Updated';
            return $data;
        }
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $category->delete();

        $data['errorStatus'] = false;
        return $data;
    }
	
	public function addCategory(Request $request){
		$dataValidation = $request->toArray();
        $errorMessages = [
                'category_name.required' => 'Category name required',
				'category_name.unique' => 'Provide unique Category'
            ];
        $validation = Validator::make($dataValidation, [
                'category_name' => 'required|unique:category,category_name'
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
				$categoryinfo = Category::create($request->all());
				$data['errorStatus'] = false;
				$data['data'] = $categoryinfo;
				$data['successmessage'] = 'Successfully Added';
				return $data;
			}
	}
	public function addUom(Request $request){
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
            } else {
				$request['date_added'] = date('Y-m-d');
				$uominfo = Uom::create($request->all());
				$data['errorStatus'] = false;
				$data['data'] = $uominfo;
				$data['successmessage'] = 'Successfully Added';
				return $data;
			}
	}
	public function addSupplier(Request $request){
		$dataValidation = $request->toArray();

        $errorMessages = [
                'supplier_number.required' => 'Supplier Number required',
				'supplier_number.unique' => 'Provide unique number',
                'supplier_name.required' => 'Name required',
                'supplier_email.required' => 'Email required',
				'supplier_email.email' => 'Provide valid email address',
				'supplier_email.unique' => 'Provide unique email address',
                'supplier_mobile_number.required' => 'Mobile Number required',
				'supplier_mobile_number.unique' => 'Provide unique mobile number',
            ];
        $validation = Validator::make($dataValidation, [
                'supplier_number' => 'required|unique:supplier,supplier_number',
                'supplier_name' => 'required',
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
}