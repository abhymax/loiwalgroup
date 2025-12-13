<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Category;
use Session;
use Validator;

class CategoryController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();

        $query = Category::withCount('product')->orderBy('date_added');

        if ($request->get('category_name_search') && $request->get('category_name_search') != '') {
            $query = $query->where('category_name', 'like', '%'.$request->get('category_name_search').'%');
        }

        $categories = $query->get();

        if(COUNT($categories) > 0){
            $data['categories'] = $categories->toArray();
        }
        if($request->ajax()){
            return view('category/category_list_ajax', compact('data'));
        }
        else{
            return view('category/category_list', compact('data'));
        }
    }

    public function store(Request $request){
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

    public function edit($id){
		
        // get the building data
        $categoryinfo = Category::where('category_id',$id)
                        ->first();
        $data['categoryinfo'] = $categoryinfo;
        return $data;
    }

    public function update(Request $request, $id){
        $category_id = $request->category_id;
        $dataValidation = $request->toArray();
        $errorMessages = [
                'category_name.required' => 'Category name required',
				'category_name.unique' => 'Provide unique Category'
            ];
        $validation = Validator::make($dataValidation, [
                'category_name' => 'required|unique:category,category_name,'.$category_id.',category_id'
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
            $categoryinfo = Category::findOrFail($category_id);
            
            $request['date_edited'] = date('Y-m-d');
            $requestData = $request->all();
            
            $categoryinfo->update($request->all());
            $data['errorStatus'] = false;
            $data['successmessage'] = 'Successfully Updated';
            return $data;
        }
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();

        $data['errorStatus'] = false;
        return $data;
    }
}