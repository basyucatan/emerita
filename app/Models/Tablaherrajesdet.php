<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablaherrajesdet extends Model
{
    use HasFactory;
	
    public $timestamps = false;

    protected $table = 'tablaherrajesdets';

    protected $fillable = ['IdTablaHerraje','cantidad','IdMaterial','default',
        'rangoMenor','rangoMayor', 'factorExtra','adicionales'];

    protected $casts = ['adicionales' => 'array','rangoMenor' => 'float',
        'rangoMayor' => 'float','factorExtra' => 'float'];

    public function setRangoMayorAttribute($value)
    {
        $this->attributes['rangoMayor'] = $value === '' ? null : $value;
    }

    public function setRangoMenorAttribute($value)
    {
        $this->attributes['rangoMenor'] = $value === '' ? 0 : $value;
    }

    public function setfactorExtraAttribute($value)
    {
        $this->attributes['factorExtra'] = $value === '' ? null : $value;
    }
    public function material()
    {
        return $this->hasOne('App\Models\Material', 'id', 'IdMaterial');
    }
    
    public function tablaherraje()
    {
        return $this->hasOne('App\Models\Tablaherraje', 'id', 'IdTablaHerraje');
    }
}
