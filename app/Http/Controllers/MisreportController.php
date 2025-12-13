<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\Models\Supplier;
use App\Models\District;
use App\Models\Invoiceout;
use App\Models\Materialout;
use App\Models\Logentry;
use App\Models\Materialin;
use App\Models\Stockavailable;
use App\Models\Product;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Session;
use Validator;
use Carbon\Carbon;
use URL;

class MisreportController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('customauth');
    }

    public function index(Request $request){
        $data = array();
        
        if($request->get('supplier_id_search') != '' && $request->get('invoice_date') != ''){
			$query = Invoiceout::with('supplier')->withSum('materialout','qty')->orderBy('date_added');

		   
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
            return view('misreport/list_ajax', compact('data'));
        }
        else{
            return view('misreport/list', compact('data'));
        }
    }
	public function export(Request $request) 
    {
         return Excel::download(new ReportExport($request->sid,$request->inv_date), 'report.xlsx');
    }
	public function exportpdf(Request $request)
	{ 
	    $query = Invoiceout::with('supplier')->withSum('materialout','qty')->orderBy('date_added');

		   
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
	    $pdf = PDF::loadView('misreport.exportpdf',['invoices'=>$invoices])->setPaper('a3', 'landscape');
	    return $pdf->download('misreport.pdf');
	}
}