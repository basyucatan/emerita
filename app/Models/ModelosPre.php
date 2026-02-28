<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelosPre extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'modelospre';

    protected $fillable = ['consecutivo','IdPresuelem','IdPresupuesto','IdModelo',
        'ancho','alto','direccion','tipo','precioU','costoU','cantidad','precioManual',
        'actualizado', 'IdColorable', 'IdColorPerfil','IdVidrio','IdColorVidrio',
        'IdLamina', 'IdGuia',
        'porRecargo', 'costeo', 'ubicacion','descripcion','foto','fichaTecnica',
        'divisiones','svg'];
    protected $casts = [
        'divisiones' => 'array',
        'costeo' => 'array',
    ];

    public function ruta()
    {
        if (!$this->foto) return null; 
        $marca = optional(optional(optional($this->Modelo)->Linea)->Marca)->marca ?? 'sin_marca';
        $ruta = asset('storage/modelospre/' . $marca . '/' . $this->foto); 
        return $ruta;
    }
	
    public function colorable()
    {
        return $this->hasOne('App\Models\Colorable', 'id', 'IdColorable');
    }
    public function colorVidrio()
    {
        return $this->hasOne('App\Models\Color', 'id', 'IdColorVidrio');
    }
    public function colorPerfil()
    {
        return $this->hasOne('App\Models\Color', 'id', 'IdColorPerfil');
    }
    public function Modelo()
    {
        return $this->hasOne('App\Models\Modelo', 'id', 'IdModelo');
    }
    public function modelopremats()
    {
        return $this->hasMany('App\Models\Modelopremat', 'IdModeloPre', 'id');
    }
    public function vidrio()
    {
        return $this->hasOne('App\Models\Vidrio', 'id', 'IdVidrio');
    }
    public function Presupuesto()
    {
        return $this->belongsTo('App\Models\Presupuesto', 'IdPresupuesto', 'id');
    }     
}
