<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
	use HasFactory;
    public $timestamps = false;
    protected $table = 'modelos';
    protected $fillable = ['IdLinea','modelo','foto','fichaTecnica','estatus','jsonSvg'];
    protected $casts = ['jsonSvg' => 'array'];
    public function getRutaFichaAttribute()
    {
        $marcaNombre = $this->linea->marca->marca ?? 'generico';
        $marcaLimpia = mb_convert_encoding($marcaNombre, 'UTF-8', 'UTF-8');
        return "modelos/" . strtolower($marcaLimpia);
    }
    public function linea()
    {
        return $this->hasOne('App\Models\Linea', 'id', 'IdLinea');
    }
    public function modelosmats()
    {
        return $this->hasMany('App\Models\Modelosmat', 'IdModelo', 'id');
    }
    public function presuelems()
    {
        return $this->hasMany('App\Models\Presuelem', 'IdModelo', 'id');
    }    
    public function modelospres()
    {
        return $this->hasMany('App\Models\Modelospre', 'IdModelo', 'id');
    }
}
