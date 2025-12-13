<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
	
	protected $table = 'warehouse';
    protected $primaryKey = 'warehouse_id';
    public $timestamps = false;
	protected $fillable = array('warehouse_name', 'warehouse_contact_person', 'warehouse_contact_number', 'warehouse_address', 'warehouse_email','date_added', 'date_edited');
	
	public function supplier()
    {
        return $this->hasMany(Supplier::class,'warehouse_id', 'warehouse_id');
    }
	public function warehousecontact()
    {
        return $this->hasMany(Warehousecontact::class,'warehouse_id','warehouse_id');
    }
	
}
