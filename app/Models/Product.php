<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
	
	protected $table = 'product';
    protected $primaryKey = 'product_id';
    public $timestamps = false;
	protected $fillable = array('category_id', 'supplier_id', 'uom_id', 'product_name', 'product_sku', 'date_added', 'date_edited');
	
	
	public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','supplier_id');
    }
	
	public function category()
    {
        return $this->belongsTo(Category::class,'category_id','category_id');
    }
	
	public function uom()
    {
        return $this->belongsTo(Uom::class,'uom_id','uom_id');
    }
	public function materialin()
    {
        return $this->hasMany(Materialin::class,'product_id','product_id');
    }
}
