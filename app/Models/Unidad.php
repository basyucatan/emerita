<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Unidad extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'unidads';

    protected $fillable = ['tipo','unidad','abreviatura','factorConversion','prueba'];

    public static function Convertir(
        float $cantidad,
        int $idOrigen,
        int $idDestino,
        ?float $rendimiento = null,
        ?int $idUnidadRend = null,
        ?string $contexto = null
    ): array {
        $ctx = $contexto ? "[Contexto: $contexto] " : "";
        try {
            $origen = self::find($idOrigen);
            $destino = self::find($idDestino);
            if (!$origen || !$destino) {
                throw new \InvalidArgumentException($ctx . 'Unidad origen o destino no encontrada.');
            }

            // ✅ CASO CON RENDIMIENTO
            if (!is_null($rendimiento)) {
                if (is_null($idUnidadRend)) {
                    throw new \InvalidArgumentException($ctx . 'Se requiere idUnidadRend cuando se proporciona rendimiento.');
                }

                // Validar unidad de rendimiento
                $unidadRend = self::find($idUnidadRend);
                if (!$unidadRend) {
                    throw new \InvalidArgumentException($ctx . 'Unidad de rendimiento no encontrada.');
                }
                // ⚠️ Validar que idUnidadRend sea del mismo tipo que la unidad origen
                if ($unidadRend->tipo !== $origen->tipo) {
                    throw new \InvalidArgumentException($ctx . 'Unidad de rendimiento y unidad destino no son del mismo tipo.');
                }

                $baseOrigen = self::where('tipo', $origen->tipo)->where('factorConversion', 1)->first();
                if (!$baseOrigen) {
                    throw new \InvalidArgumentException($ctx . 'Unidad base no encontrada para el tipo: ' . $origen->tipo);
                }

                // Convertimos rendimiento a unidad origen
                $rendimientoEnOrigen = $rendimiento * ($origen->factorConversion / $unidadRend->factorConversion);
                $piezas = $cantidad / $rendimientoEnOrigen;

                // ✅ Redondeo a entero, 0.5 o entero siguiente
                $entero = floor($piezas);
                $decimal = $piezas - $entero;

                if ($decimal <= 0.25) {
                    $valor = $entero;
                } elseif ($decimal <= 0.75) {
                    $valor = $entero + 0.5;
                } else {
                    $valor = ceil($piezas);
                }

                return ['valor' => $valor, 
                    'unidad' => $destino->abreviatura . ' (' . ($cantidad / 1000) . 'm, 1 tubo/11m)'];
            }

            // ✅ CONVERSIÓN SIMPLE
            if ($origen->tipo !== $destino->tipo) {
                throw new \InvalidArgumentException($ctx . 'Las unidades no son del mismo tipo y no se proporcionó rendimiento.');
            }

            $base = self::where('tipo', $destino->tipo)
                        ->where('factorConversion', 1)
                        ->first();
            if (!$base) {
                throw new \InvalidArgumentException($ctx . 'Unidad base no encontrada para el tipo ' . $destino->tipo);
            }

            $valor = $cantidad * $destino->factorConversion;
            if ($base->id == $base->id)
                $valor = $cantidad / $origen->factorConversion;
            return ['valor' => $valor, 'unidad' => $destino->abreviatura.' (1.55)'];

        } catch (\Throwable $e) {
            Log::channel('logsBase')->error($ctx . $e->getMessage());
            return ['valor' => 0, 'unidad' => 'Error'];
        }
    }


}
