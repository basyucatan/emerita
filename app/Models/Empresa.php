<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'empresas';

    protected $fillable = ['IdNegocio','tipo','empresa','direccion','gmaps','telefono','email','adicionales'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresascontactos()
    {
        return $this->hasMany('App\Models\Empresascontacto', 'IdEmpresa', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresassucs()
    {
        return $this->hasMany('App\Models\Empresassuc', 'IdEmpresa', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function negocio()
    {
        return $this->hasOne('App\Models\Negocio', 'id', 'IdNegocio');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function obras()
    {
        return $this->hasMany('App\Models\Obra', 'IdEmpresa', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presupuestos()
    {
        return $this->hasMany('App\Models\Presupuesto', 'IdCliente', 'id');
    }
    
}
