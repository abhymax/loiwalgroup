<?php
  
namespace App\Exports;
  
use App\Models\Invoiceout;
//use Maatwebsite\Excel\Concerns\FromCollection;
//use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

  
//class ReportExport implements FromCollection, WithHeadings
class ReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
	protected $id;
    protected $inv_date;
	function __construct($sid,$inv_date) {
			$this->id = $sid;
			$this->inv_date = $inv_date;
	}
    public function view(): View
    {
		$year_month_arr = explode("-",$this->inv_date);
		$invoices = Invoiceout::select("invoice_date", "invoice_number", "party_name", "party_name", "transport", "dispatch_date", "delivery_date", "remarks")->with('supplier')->withSum('materialout','qty')->where('supplier_id', $this->id)->whereYear('invoice_date','=', $year_month_arr[0])->whereMonth('invoice_date','=', $year_month_arr[1])->orderBy('date_added')->get();
		
		return view('misreport/exportlist', compact('invoices'));
        
    }
  /*  public function collection()
    {
        //return User::select("id", "name", "email")->get();
		$year_month_arr = explode("-",$this->inv_date);
		return Invoiceout::select("invoice_date", "invoice_number", "party_name", "party_name", "transport", "dispatch_date", "delivery_date", "remarks")->with('supplier')->where('supplier_id', $this->id)->whereYear('invoice_date','=', $year_month_arr[0])->whereMonth('invoice_date','=', $year_month_arr[1])->orderBy('date_added')->get();
    } */
  
    /**
     * Write code on Method
     *
     * @return response()
     */
   /* public function headings(): array
    {
        return ["Date", "Doc No", "Source", "Destination", "Transport Name", "Dispatch Date", "Qty", "Delivery Date", "Remarks"];
    }*/
}