<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'monedas';

    protected $fillable = ['moneda','centavos','simbolo','abreviatura','tipoCambio'];
	
}
