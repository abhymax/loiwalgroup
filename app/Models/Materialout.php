<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialout extends Model
{
    use HasFactory;
	
	protected $table = 'material_out';
    protected $primaryKey = 'material_id';
    public $timestamps = false;
	protected $fillable = array('invoice_out_id', 'product_id', 'product_sku', 'product_name', 'batch_no', 'qty', 'rate', 'amount');
	
	
	public function invoiceout()
    {
        return $this->belongsTo(Invoiceout::class,'invoice_out_id','id');
    }
	public function product()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }

}
