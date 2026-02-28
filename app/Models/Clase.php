<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'clases';

    protected $fillable = ['clase','orden'];
	
    public function materials()
    {
        return $this->hasMany('App\Models\Material', 'IdClase', 'id');
    }
    
}
