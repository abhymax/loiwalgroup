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
use App\Models\Product;
use App\Exports\InwardreportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Session;
use Validator;
use Carbon\Carbon;
use URL;

class InwardreportController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();
        //exit;
        if($request->get('supplier_id_search') != '' && $request->get('invoice_date') != ''){
			
			$query = Stocktransfer::with('supplier')->with('stocktransfermaterial')->withSum('stocktransfermaterial','qty')->orderBy('date_added');

		   
			if ($request->get('supplier_id_search') && $request->get('supplier_id_search') != '') {
				$query = $query->where('supplier_id', $request->get('supplier_id_search'));
			}
			if ($request->get('invoice_date') && $request->get('invoice_date') != '') {
				$year_month_arr = explode("-",$request->get('invoice_date'));
				$query = $query->whereYear('invoice_date','=', $year_month_arr[0]);
				$query = $query->whereMonth('invoice_date','=', $year_month_arr[1]);
			}
			
			$invoice = $query->get();

			if(COUNT($invoice) > 0){
				$data['reports'] = $invoice->toArray();
				
			}
			
		} 
		
		$data['suppliers'] = Supplier::orderby('supplier_name')->get();
		$data['sid'] = $request->get('supplier_id_search');
		$data['inv_date'] = $request->get('invoice_date');
        if($request->ajax()){
            return view('inwardreport/list_ajax', compact('data'));
        }
        else{
            return view('inwardreport/list', compact('data'));
        }
    }
	public function export(Request $request) 
    {
         return Excel::download(new InwardreportExport($request->sid,$request->inv_date), 'inwardreport.xlsx');
    }
	public function exportpdf(Request $request)
	{ 
	    $query = Stocktransfer::with('supplier')->with('stocktransfermaterial')->withSum('stocktransfermaterial','qty')->orderBy('date_added');


		   
		if ($request->sid && $request->sid != '') {
			$query = $query->where('supplier_id', $request->sid);
		}
		if ($request->inv_date && $request->inv_date != '') {
			$year_month_arr = explode("-",$request->inv_date);
			$query = $query->whereYear('invoice_date','=', $year_month_arr[0]);
			$query = $query->whereMonth('invoice_date','=', $year_month_arr[1]);
		}
		
		$invoices['items'] = $query->get();
		$invoices['month_yr'] = Carbon::parse($request->inv_date)->format('M-Y'); ;
	    $pdf = PDF::loadView('inwardreport.exportpdf',['invoices'=>$invoices])->setPaper('a3', 'landscape');
	    return $pdf->download('inwardreport.pdf');
	}
}