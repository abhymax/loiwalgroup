<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoiceout extends Model
{
    use HasFactory;
	
	protected $table = 'invoice_out';
    protected $primaryKey = 'id';
    public $timestamps = false;
	protected $fillable = array('party_name', 'destination', 'district_id', 'invoice_number', 'invoice_date', 'dispatch_date', 'ewaybill_no', 'ewaybill_updated', 'transport', 'truck_no', 'supplier_id', 'total_amount', 'lr_no', 'is_delivered', 'delivery_date', 'pod_status', 'date_added', 'date_edited');
	
	
	public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','supplier_id');
    }
	public function district()
    {
        return $this->belongsTo(District::class,'district_id','district_id');
    }
	
	public function materialout()
    {
        return $this->hasMany(Materialout::class,'invoice_out_id','id');
    }
	
}
