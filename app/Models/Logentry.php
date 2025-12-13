<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logentry extends Model
{
    use HasFactory;
	
	protected $table = 'log_entry';
    protected $primaryKey = 'log_id';
    public $timestamps = false;
	protected $fillable = array('log_type', 'product_id', 'supplier_id', 'batch_no', 'qty', 'entry_date', 'created_at','log_details');
	
	public function product()
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
	public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','supplier_id');
    }
}
