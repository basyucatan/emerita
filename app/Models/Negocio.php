<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'negocios';

    protected $fillable = ['negocio','razonSocial','logo','adicionales'];
	
    public function empresas()
    {
        return $this->hasMany('App\Models\Empresa', 'IdNegocio', 'id');
    }
    
    public function negociosdivs()
    {
        return $this->hasMany('App\Models\Negociosdiv', 'IdNegocio', 'id');
    }
    
}
