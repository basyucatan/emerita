<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialscosto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'materialscostos';

    protected $fillable = ['IdMaterial','referencia', 'ubicacion', 'IdColor',
        'IdVidrio','IdBarra','IdPanel','IdUnidad','direccion','costo','IdMoneda'];
    protected $casts = ['ubicacion' => 'array',];
    public function getUnidadAttribute()
    {
        if ($this->barra) {
            return $this->barra->descripcion ?? 'pieza';
        }
        if ($this->panel) {
            return $this->panel->panel ?? 'pieza';
        }
        return $this?->material?->unidad?->unidad ?? 'pieza';
    }	       
    public function movInventarios()
    {
        return $this->hasMany(Movinventario::class, 'IdMatCosto');
    }

    public function existencia($IdDepto)
    {
        $movs = $this->movInventarios()
            ->selectRaw("
                SUM(CASE WHEN IdDeptoDes = ? THEN cantidad ELSE 0 END) AS entradas,
                SUM(CASE WHEN IdDeptoOri = ? THEN cantidad ELSE 0 END) AS salidas
            ", [$IdDepto, $IdDepto])
            ->first();
        return round(($movs->entradas ?? 0) - ($movs->salidas ?? 0), 3);
    }
    public function getValoresAttribute()
    {
        $IdUMaterial = $this->material?->IdUnidad ?? 1;
        $valorUReal = $this->costo;
        if ($this->barra) {
            if ($IdUMaterial == 3) { // Se costea por metro
                $longitudBarra = floatval($this->barra->longitud ?? 0);
                $valorUReal = $this->costo * $longitudBarra / 1000;
            }
        }
        $valorUReal =(float) $valorUReal;
        $valorURealMXN = $valorUReal * $this->Moneda->tipoCambio;
        $valores = [
            'valorUReal' => $valorUReal,
            'valorURealMXN' => $valorURealMXN,
        ];
        return $valores;
    }    
    public function getCostoBarraMXNAttribute()
    {
        return $this->CostoTraducido * $this->Moneda->tipoCambio;
    }     
    public function kardex($IdDepto)
    {
        $movs = $this->movInventarios()
            ->with([
                'DeptoOri:id,depto',
                'DeptoDes:id,depto',
                'UserOri:id,name',
                'UserDes:id,name',
            ])
            ->where(function ($q) use ($IdDepto) {
                $q->where('IdDeptoDes', $IdDepto)
                ->orWhere('IdDeptoOri', $IdDepto);
            })
            ->orderBy('fechaH', 'asc')
            ->orderBy('id', 'asc') // asegura orden estable si misma fecha
            ->get();

        $saldo = 0;
        foreach ($movs as $mov) {
            if ($mov->IdDeptoDes == $IdDepto) {
                $mov->sentido = 'Entrada';
                $saldo += $mov->cantidad;
            } elseif ($mov->IdDeptoOri == $IdDepto) {
                $mov->sentido = 'Salida';
                $saldo -= $mov->cantidad;
            }
            $mov->saldo = round($saldo, 3);
            $mov->unidad = $this->Unidad;
        }
        return $movs->sortByDesc(fn($m) => [$m->fechaH, $m->id])->values();
    }

public function existRetales(): array
{
    $deptos = [3, 4]; // Departamentos a considerar
    $longitudBarra = $this->Barra->longitud ?? 0;
    $esVidrio = ($this->material->IdClase ?? null) == 2; // 2 = clase vidrio
    $existencias = [];

    $movs = $this->movInventarios()
        ->where(function ($q) use ($deptos) {
            $q->whereIn('IdDeptoDes', $deptos)
              ->orWhereIn('IdDeptoOri', $deptos);
        })
        ->orderBy('fechaH')
        ->get();
    foreach ($movs as $mov) {
        $esEntrada = in_array($mov->IdDeptoDes, $deptos);
        $esSalida  = in_array($mov->IdDeptoOri, $deptos);

        if ($esEntrada) {
            if ($esVidrio) {
                if (!empty($mov->dimensiones)) {
                    $dimensiones = array_map('trim', explode(',', $mov->dimensiones));
                    $ancho = (float)($dimensiones[0] ?? 0);
                    $alto  = (float)($dimensiones[1] ?? 0);
                    $area = round(($ancho * $alto) / 1_000_000, 6); // m²
                    for ($i = 0; $i < ceil($mov->cantidad); $i++) {
                        $existencias[] = [
                            'ancho'    => $ancho,
                            'alto'     => $alto,
                            'area'     => $area,
                            'cantidad' => 1.0,
                        ];
                    }
                } else {
                    $panelAncho = ($this->Panel->ancho ?? 0) * 1000;
                    $panelAlto  = ($this->Panel->alto ?? 0) * 1000;
                    $panelArea  = round(($panelAncho * $panelAlto) / 1_000_000, 6);
                    $existencias[] = [
                        'ancho'    => (float)$panelAncho,
                        'alto'     => (float)$panelAlto,
                        'area'     => $panelArea,
                        'cantidad' => 1.0,
                    ];
                }
            } else {
                $dim = !empty($mov->dimensiones) ? (float)$mov->dimensiones : $longitudBarra;
                for ($i = 0; $i < $mov->cantidad; $i++) {
                    $existencias[] = [
                        'ancho'    => $dim,
                        'alto'     => 0,
                        'area'     => $dim,
                        'cantidad' => 1.0,
                    ];
                }
            }
        }

        if ($esSalida) {
            for ($i = 0; $i < $mov->cantidad; $i++) {
                array_shift($existencias);
            }
        }
    }

    // Ordenar existencias
    if ($esVidrio) {
        usort($existencias, fn($a, $b) => ($b['area'] ?? 0) <=> ($a['area'] ?? 0));
    } else {
        usort($existencias, fn($a, $b) => ($b['ancho'] ?? 0) <=> ($a['ancho'] ?? 0));
    }
    return $existencias;
}

  
    public function Moneda(){return $this->belongsTo('App\Models\Moneda', 'IdMoneda', 'id');}    
    public function barra(){return $this->belongsTo('App\Models\Barra', 'IdBarra', 'id');}
    public function panel(){return $this->belongsTo('App\Models\Panel', 'IdPanel', 'id');}
    public function color(){return $this->belongsTo('App\Models\Color', 'IdColor', 'id');}
    public function material(){return $this->belongsTo('App\Models\Material', 'IdMaterial', 'id');}
    public function unidad(){return $this->belongsTo('App\Models\Unidad', 'IdUnidad', 'id');}
    public function vidrio(){return $this->hasOne('App\Models\Vidrio', 'id', 'IdVidrio');}

    public function getUbiCodificadaAttribute()
    {
        if (!$this->ubicacion) {
            return null;
        }

        $zona = strtoupper($this->ubicacion['zona'] ?? 'X');
        $pasillo = $this->ubicacion['pasillo'] ?? 'X';
        $anaquel = $this->ubicacion['anaquel'] ?? '0';
        $posicion = $this->ubicacion['posicion'] ?? '0';

        return "{$zona}|{$pasillo}|{$anaquel}-{$posicion}";
    }

    public function scopeWhereUbiCodificada($query, $keyword)
    {
        $keyword = "%{$keyword}%";
        return $query->whereRaw("CONCAT(
            UPPER(JSON_UNQUOTE(JSON_EXTRACT(ubicacion, '$.zona'))), '|',
            JSON_UNQUOTE(JSON_EXTRACT(ubicacion, '$.pasillo')),
            JSON_UNQUOTE(JSON_EXTRACT(ubicacion, '$.anaquel')), '-',
            JSON_UNQUOTE(JSON_EXTRACT(ubicacion, '$.posicion'))
        ) LIKE ?", [$keyword]);
    }
    
}
