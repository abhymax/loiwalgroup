<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicein extends Model
{
    use HasFactory;
	
	protected $table = 'invoice_in';
    protected $primaryKey = 'id';
    public $timestamps = false;
	protected $fillable = array('invoice_number', 'invoice_date', 'receive_date', 'supplier_id', 'transport_document_number', 'total_amount', 'date_added', 'date_edited');
	
	
	public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','supplier_id');
    }
	
	public function materialin()
    {
        return $this->hasMany(Materialin::class,'invoice_id','id');
    }
	
}
