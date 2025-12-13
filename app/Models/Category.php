<?php  

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
	
	protected $table = 'category';
    protected $primaryKey = 'category_id';
    public $timestamps = false;
	protected $fillable = array('category_name', 'category_description', 'date_added', 'date_edited');
	
	public function product()
    {
        return $this->hasMany(Product::class,'category_id','category_id');
    }
	
}
