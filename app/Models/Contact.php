<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $primaryKey = 'contact_id';
    public $timestamps = false;
	protected $fillable = array('name', 'email', 'phone', 'comments', 'date_added');
}
