<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehousecontact extends Model
{
    use HasFactory;
	
	protected $table = 'warehouse_contact';
    protected $primaryKey = 'warehouse_contact_id';
    public $timestamps = false;
	protected $fillable = array('warehouse_id', 'warehouse_contact_email', 'warehouse_contact_no');
	
	
	public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','warehouse_id');
    }
	

}
