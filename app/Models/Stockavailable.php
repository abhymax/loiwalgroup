<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockavailable extends Model
{
    use HasFactory;
	
	protected $table = 'available';
    protected $primaryKey = 'id';
    public $timestamps = false;
	protected $fillable = array('product_id', 'supplier_id', 'batch_no', 'product_sku', 'available_qty');
	
	public function product()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
	public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','supplier_id');
    }
}
