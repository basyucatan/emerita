<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocompra extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'ocompras';

    protected $fillable = ['IdDivision','IdProveedor','IdUser','IdObra','IdCondPago','IdCondFlete','fechaHSol','fechaERec','porDescuento','concepto','estatus','adicionales'];
	
    public function division()
    {
        return $this->hasOne('App\Models\Division', 'id', 'IdDivision');
    }
    
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'id', 'IdProveedor');
    }
    
    public function obra()
    {
        return $this->hasOne('App\Models\Obra', 'id', 'IdObra');
    }
    
    public function ocomprasdets()
    {
        return $this->hasMany('App\Models\Ocomprasdet', 'IdOCompra', 'id');
    }
    
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'IdUser');
    }
    
}
