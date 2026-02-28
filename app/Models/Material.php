<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'materials';

    protected $fillable = ['IdClase','IdUnidad','IdLinea','IdTipo','referencia', 'KgxMetro',
        'rendimiento', 'IdUnidadRend', 'material','foto','costoU','stockMin','adicionales'];
    protected $casts = ['adicionales' => 'array'];
    public function getRutaFotoAttribute()
    {
        $marcaNombre = $this->Linea->Marca->marca ?? 'generico';
        $marcaLimpia = mb_convert_encoding($marcaNombre, 'UTF-8', 'UTF-8');
        return "materiales/" . strtolower($marcaLimpia);
    }
    public function Unidad()
    {
        return $this->hasOne('App\Models\Unidad', 'id', 'IdUnidad');
    }   
    public function materialessmetas()
    {
        return $this->hasMany('App\Models\Materialessmeta', 'IdMaterial', 'id');
    }
    public function Clase()
    {
        return $this->hasOne('App\Models\Clase', 'id', 'IdClase');
    }    
    public function Linea()
    {
        return $this->hasOne('App\Models\Linea', 'id', 'IdLinea');
    }    
    public function Tipo()
    {
        return $this->hasOne('App\Models\Tipo', 'id', 'IdTipo');
    }    
    public function Costos()
    {
        return $this->hasMany('App\Models\Materialscosto', 'IdMaterial', 'id');
    } 
    public function Materialscostos()
    {
        return $this->hasMany('App\Models\Materialscosto', 'IdMaterial', 'id');
    }     
    public function Reglas()
    {
        return $this->hasMany('App\Models\Regla', 'IdMaterial', 'id');
    } 
    public function UnidadRend()
    {
        return $this->hasOne('App\Models\Unidad', 'id', 'IdUnidadRend');
    }     
}
