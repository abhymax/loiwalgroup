<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    use HasFactory;
	
	protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';
    public $timestamps = false;
	protected $fillable = array('supplier_number', 'warehouse_id', 'supplier_name', 'supplier_address', 'supplier_city', 'supplier_contact_person', 'supplier_contact_person_ho', 'supplier_phone_number','supplier_email','supplier_mobile_number','contact_emails','contact_numbers','date_added', 'date_edited');
	
	public function product()
    {
        return $this->hasMany(Product::class,'supplier_id', 'supplier_id');
    }
	public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','warehouse_id');
    }
	public function subadmins()
    {
        return $this->belongsToMany(Adminusers::class, 'admin_supplier','supplier_id','admin_id');
    }
}
