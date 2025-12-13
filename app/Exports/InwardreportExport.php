<?php
  
namespace App\Exports;
  
use App\Models\Stocktransfer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
  
class InwardreportExport implements FromView
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
		$stocktransfers = Stocktransfer::with('supplier')->with('stocktransfermaterial')->withSum('stocktransfermaterial','qty')->orderBy('date_added')->where('supplier_id', $this->id)->whereYear('invoice_date','=', $year_month_arr[0])->whereMonth('invoice_date','=', $year_month_arr[1])->get();
		
		return view('inwardreport/exportlist', compact('stocktransfers'));
    }
  
    
}