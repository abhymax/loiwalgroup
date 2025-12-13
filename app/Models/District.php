<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
	
	protected $table = 'district';
    protected $primaryKey = 'district_id';
    public $timestamps = false;
	protected $fillable = array('district_name', 'date_added', 'date_edited');
	
	public function invoiceout()
    {
        return $this->hasMany(Invoiceout::class,'district_id', 'district_id');
    }
}
