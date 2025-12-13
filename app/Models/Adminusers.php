<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminusers extends Model
{
    use HasFactory;
	
	protected $table = 'admin';
    public $timestamps = false;
	protected $primaryKey = 'admin_id';
	
	protected $fillable = array('admin_email', 'admin_username', 'admin_password', 'admin_type_id', 'is_active', 'date_added', 'date_edited');
	
	
	public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'admin_supplier', 'admin_id', 'supplier_id');
    }
}
