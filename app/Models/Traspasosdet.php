<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traspasosdet extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'traspasosdets';

    protected $fillable = ['IdTraspaso','IdMatCosto','cantidad','valorU',
        'dimensiones','adicionales'];
    protected $casts = ['adicionales' => 'array'];
    
    public function getValoresAttribute()
    {
        $matCosto = $this->matCosto();
        $costo = $matCosto?->Valores['valorUReal'] ?? 0;
        $importe = $costo * $this->cantidad;
        $moneda = $this->matCosto()?->moneda;
        $tipoC = 1;
        if ($moneda && isset($moneda->id)) {
            if ($moneda->id == 2) {
                $tipoC = $this->traspaso?->adicionales['tipoCEuro'] ?? 1;
            } elseif ($moneda->id == 3) {
                $tipoC = $this->traspaso?->adicionales['tipoCDolar'] ?? 1;
            } else {
                $tipoC = 1;
            }
        }
        return [
            'importe' => $importe,
            'importeMXN' => $importe * $tipoC,
            'tipoC' => $tipoC,
            'simbolo' =>  $moneda?->simbolo ?? '$',
        ];
    }
      
    public function ConvertirCantidad()
    {
        $unidad = $this->Unidad;
        if ($unidad === 'pieza') {
            return $this->cantidad ?? 1;
        }
        if ($this->matCosto()?->barra) {
            $longitudBarra = floatval($this->matCosto()->barra->longitud ?? 0);
            $dim = floatval($this->dimensiones ?? 0);
            if ($longitudBarra > 0 && $dim > 0) {
                $this->cantidad = round($dim / $longitudBarra, 3);
                return $this->cantidad;
            }
            return 1;
        }
        if ($this->matCosto()?->panel) {
            $partes = array_map('trim', explode(',', $this->dimensiones ?? ''));
            if (count($partes) !== 2) {
                return 1;
            }
            [$ancho, $alto] = array_map('floatval', $partes);
            if ($ancho <= 0 || $alto <= 0) {
                return 1;
            }
            $areaDim = $ancho/1000 * $alto/1000;
            $areaPanel = ($this->matCosto()->panel->ancho ?? 0) * ($this->matCosto()->panel->alto ?? 0);
            if ($areaPanel <= 0) {
                return 1;
            }
            $this->cantidad = round($areaDim / $areaPanel, 3);
            return $this->cantidad;
        }
        return $this->cantidad ?? 1;
    }

    private function matCosto()
    {
        return $this->materialscosto;
    }
    public function getColorAttribute()
    {
        return $this->matCosto()?->color ?? null;
    }

    public function getReferenciaAttribute()
    {
        return trim($this->matCosto()?->referencia ?? '');
    }

    public function getMaterialAttribute()
    {
        return trim($this->matCosto()?->material?->material ?? '');
    }

    public function getUnidadAttribute()
    {
        $matCosto = $this->matCosto();
        if ($matCosto?->barra) {
            return $matCosto->barra->descripcion ?? 'pieza';
        }
        if ($matCosto?->panel) {
            return $matCosto->panel->panel ?? 'pieza';
        }
        return $matCosto?->material?->unidad?->unidad ?? 'pieza';
    }
    public function materialscosto()
    {
        return $this->hasOne('App\Models\Materialscosto', 'id', 'IdMatCosto');
    }
    
    public function traspaso()
    {
        return $this->belongsTo(Traspaso::class, 'IdTraspaso', 'id');
    }
    
}
