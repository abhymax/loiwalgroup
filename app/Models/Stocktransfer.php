<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocktransfer extends Model
{
    use HasFactory;
	
	protected $table = 'stock_transfer';
    protected $primaryKey = 'stock_transfer_id';
    public $timestamps = false;
	protected $fillable = array('party_name', 'destination', 'invoice_number', 'invoice_date', 'dispatch_date', 'ewaybill_no', 'ewaybill_updated', 'transport', 'truck_no', 'supplier_id', 'total_amount', 'lr_no', 'is_delivered', 'delivery_date', 'pod_status', 'date_added', 'date_edited');
	
	
	public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','supplier_id');
    }
	
	public function stocktransfermaterial()
    {
        return $this->hasMany(Stocktransfermaterial::class,'stock_transfer_id','stock_transfer_id');
    }
	
}
