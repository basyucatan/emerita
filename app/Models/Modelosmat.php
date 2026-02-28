<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelosmat extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'modelosmats';

    protected $fillable = ['IdModelo','principal','cantidad','IdMaterial','IdTablaHerraje','cantidadHerraje','diferenciador','IdTipo','posicion','formula','errFormula','dimensiones','costo','tipCosto','adicionales','obs'];
	
    public function getDimsAttribute(): string
    {
        $dims = explode(',', $this->dimensiones ?? '');
        $dims = collect($dims)->filter();

        return $dims->map(function($d) use ($dims) {
            $numero = number_format((float) $d, 0, '.', ',');
            return count($dims) > 1 ? "[$numero]" : $numero;
        })->implode(', ');
    }
    
    public function Tipo()
    {
        return $this->hasOne('App\Models\Tipo', 'id', 'IdTipo');
    }     
    public function material()
    {
        return $this->hasOne('App\Models\Material', 'id', 'IdMaterial');
    }
    public function reglas()
    {
        return $this->hasMany(\App\Models\Regla::class, 'IdMaterial', 'IdMaterial');
    }     
    public function modelo()
    {
        return $this->hasOne('App\Models\Modelo', 'id', 'IdModelo');
    }
    public function tablaherraje()
    {
        return $this->hasOne('App\Models\Tablaherraje', 'id', 'IdTablaHerraje');
    }
}
