<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelopremat extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'modelopremats';

    protected $fillable = ['IdModeloPre','IdMaterialCosto','principal','cantidad',
        'IdMaterial','diferenciador','IdTipo','posicion','formula','errFormula',
        'dimensiones','costo','tipCosto','obs','IdTablaHerraje','cantidadHerraje','adicionales'];
    protected $casts = ['adicionales' => 'array'];

    public function setIdTablaHerrajeAttribute($value)
    {
        $this->attributes['IdTablaHerraje'] = $value === '' ? null : $value;
    }    
    public function getDimsAttribute(): string
    {
        $dims = explode(',', $this->dimensiones ?? '');
        $dims = collect($dims)->filter();

        return $dims->map(function($d) use ($dims) {
            $numero = number_format((float) $d, 0, '.', ',');
            return count($dims) > 1 ? "[$numero]" : $numero;
        })->implode(', ');
    }
    public function materialscosto()
    {
        return $this->hasOne('App\Models\Materialscosto', 'id', 'IdMaterialCosto');
    }
    
    public function Tipo()
    {
        return $this->hasOne('App\Models\Tipo', 'id', 'IdTipo');
    } 
    public function materialCosto()
    {
        return $this->hasOne('App\Models\Materialscosto', 'id', 'IdMaterialCosto');
    }    
    public function material()
    {
        return $this->hasOne('App\Models\Material', 'id', 'IdMaterial');
    }
    public function reglas()
    {
        return $this->hasMany(\App\Models\Regla::class, 'IdMaterial', 'IdMaterial');
    }
    public function ModelosPre()
    {
        return $this->belongsTo('App\Models\ModelosPre', 'IdModeloPre', 'Id');
    }    
    
}
