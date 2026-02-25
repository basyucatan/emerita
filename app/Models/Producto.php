<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'productos';

    protected $fillable = ['codigo','foto','linkCMSG','producto','IdClase','precioU','precioN','costoU','stockMin','pDescuento','activo','obs'];
    public function Clase()
    {
        return $this->hasOne('App\Models\Clase', 'id', 'IdClase');
    }
}
