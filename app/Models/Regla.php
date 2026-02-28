<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regla extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'reglas';

    protected $fillable = ['IdLinea','IdMaterial','IdTipo','IdMatRelacion','baseCalculo',
        'efectoCalculo','factor', 'descuento','IdVidrio'];
	
    public function setIdLineaAttribute($value)
    {
        $this->attributes['IdLinea'] = $value === '' ? null : $value;
    }
    public function linea()
    {
        return $this->hasOne('App\Models\Linea', 'id', 'IdLinea');
    }
    public function Tipo()
    {
        return $this->hasOne('App\Models\Tipo', 'id', 'IdTipo');
    }
    public function Vidrio()
    {
        return $this->hasOne('App\Models\Vidrio', 'id', 'IdVidrio');
    }    
    public function material()
    {
        return $this->hasOne('App\Models\Material', 'id', 'IdMaterial');
    }
    public function materialRel()
    {
        return $this->hasOne('App\Models\Material', 'id', 'IdMatRelacion');
    }
    
    
}
