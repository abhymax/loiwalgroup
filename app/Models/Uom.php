<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    use HasFactory;
	
	protected $table = 'uom';
    protected $primaryKey = 'uom_id';
    public $timestamps = false;
	protected $fillable = array('uom_name', 'uom_description', 'date_added', 'date_edited');
	
	
	public function product()
    {
        return $this->hasMany(Product::class,'uom_id','uom_id');
    }
}
