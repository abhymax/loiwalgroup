<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocktransfermaterial extends Model
{
    use HasFactory;
	
	protected $table = 'transfer_material';
    protected $primaryKey = 'material_id';
    public $timestamps = false;
	protected $fillable = array('stock_transfer_id', 'product_id', 'product_sku', 'product_name', 'batch_no', 'qty', 'rate', 'amount');
	
	
	public function stocktransfer()
    {
        return $this->belongsTo(Stocktransfer::class,'stock_transfer_id','stock_transfer_id');
    }
	public function product()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }

}
