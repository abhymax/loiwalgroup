<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
	
	protected $table = 'settings';
    public $timestamps = false;
	//protected $primaryKey = 'admin_id';
	
	protected $fillable = array('shipment_request_email', 'delivery_quote_email', 'contact_email', 'footer_copyrights');
}
