<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Helper\Commonhelper;
use DB;
use File;
use Session;
use Validator;

class DashboardController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }
    public function index(){
        $data = array();
        /*$data['shipmentcount'] = Shipment::count();
        $data['shippercount'] = Shipper::count();
        $data['inventorycount'] = Inventory::count();
        $data['quptecount'] = DeliveryQuote::count();

        $data['delivery_quote'] = DeliveryQuote::orderBy('delivery_quote_date', 'asc')->limit(5)->get();
        $data['inventory'] = Inventory::orderBy('add_date', 'asc')->limit(5)->get();*/

        return view('dashboard/dashboard',compact('data'));
    }
    
}    