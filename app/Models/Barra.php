<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barra extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'barras';

    protected $fillable = ['longitud','descripcion'];
	
}
