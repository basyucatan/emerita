<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Util;

class Movinventario extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'movinventarios';

    protected $fillable = ['IdUserOri','IdUserDes','tipo','IdMatCosto','IdDeptoOri',
        'IdDeptoDes','fechaH','cantidad','valorU','dimensiones','adicionales'];
    protected $casts = ['adicionales' => 'array'];
	
    public function getFechaHoraAttribute(){
        return (Util::formatFecha($this->fechaH,'CortaDhm'));
    }
    public function getValoresAttribute()
    {
        $matCosto = $this->materialscosto ?? null;
        $IdUMaterial = $matCosto?->material?->IdUnidad ?? 1;
        $valorUReal = $this->valorU ?? 0;
        if ($matCosto->barra) {
            if ($IdUMaterial == 3) { // Se costea por metro
                $longitudBarra = floatval($matCosto->barra->longitud ?? 0);
                $valorUReal = $this->valorU * $longitudBarra / 1000;
            }
        }
        $valorURealMXN = $valorUReal * $matCosto->Moneda->tipoCambio;
        $valores = [
            'unidad' => $matCosto->Unidad,
            'valorUReal' => $valorUReal,
            'valorURealMXN' => $valorURealMXN,
        ];
        return $valores;
    } 
    public function userOri()
    {
        return $this->belongsTo('App\Models\User', 'IdUserOri', 'id');
    }

    public function userDes()
    {
        return $this->belongsTo('App\Models\User', 'IdUserDes', 'id');
    }

    public function materialscosto()
    {
        return $this->belongsTo('App\Models\Materialscosto', 'IdMatCosto', 'id');
    }

    public function deptoOri()
    {
        return $this->belongsTo('App\Models\Depto', 'IdDeptoOri', 'id');
    }

    public function deptoDes()
    {
        return $this->belongsTo('App\Models\Depto', 'IdDeptoDes', 'id');
    }
}
