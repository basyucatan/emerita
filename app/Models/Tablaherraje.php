<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablaherraje extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'tablaherrajes';

    protected $fillable = ['IdLinea','tablaHerraje','fichaTecnica','posicion'];

    public function linea()
    {
        return $this->hasOne('App\Models\Linea', 'id', 'IdLinea');
    }

    public function modelopremats()
    {
        return $this->hasMany('App\Models\Modelopremat', 'IdTablaHerraje', 'id');
    }

    public function modelosmats()
    {
        return $this->hasMany('App\Models\Modelosmat', 'IdTablaHerraje', 'id');
    }

    public function tablaherrajesdets()
    {
        return $this->hasMany('App\Models\Tablaherrajesdet', 'IdTablaHerraje', 'id');
    }
    
}
