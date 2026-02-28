<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'lineas';

    protected $fillable = ['IdMarca','IdDivision','IdColorablePerfil','linea','orden'];
	

    public function colorable()
    {
        return $this->hasOne('App\Models\Colorable', 'id', 'IdColorablePerfil');
    }
    

    public function marca()
    {
        return $this->hasOne('App\Models\Marca', 'id', 'IdMarca');
    }
    
    public function Division()
    {
        return $this->hasOne('App\Models\Division', 'id', 'IdDivision');
    }
    public function materials()
    {
        return $this->hasMany('App\Models\Material', 'IdLinea', 'id');
    }
    

    public function modelos()
    {
        return $this->hasMany('App\Models\Modelo', 'IdLinea', 'id');
    }
    

    public function reglas()
    {
        return $this->hasMany('App\Models\Regla', 'IdLinea', 'id');
    }
    
}
