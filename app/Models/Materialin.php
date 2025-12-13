<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialin extends Model
{
    use HasFactory;
	
	protected $table = 'material_in';
    protected $primaryKey = 'material_id';
    public $timestamps = false;
	protected $fillable = array('invoice_id', 'product_id', 'product_sku', 'product_name', 'batch_no', 'description', 'qty', 'rate', 'amount',
	'manufacturing_date', 'expiry_date');
	
	
	public function invoicein()
    {
        return $this->belongsTo(Invoicein::class,'invoice_id','id');
    }
	public function product()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }

}
