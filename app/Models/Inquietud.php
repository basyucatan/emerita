<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Util;

class Inquietud extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'inquietuds';

    protected $fillable = ['IdComiteDes','fecha','nombre','telefono','titulo',
        'inquietud','respuesta','estatus', 'adicionales'];
	protected $casts = ['adicionales' => 'array',];

    public static function ads($actuales, $user, ?array $dirty = null, ?array $original = null): array
    {
        $actuales = is_array($actuales) ? $actuales : [];
        $nuevo = [
            'Fecha' => now()->tz('America/Mexico_City'),
            'Usuario' => $user->name ?? 'N/A'
        ];
        if (!empty($dirty)) {
            $cambios = [];
            foreach ($dirty as $campo => $valorNuevo) {
                $cambios[$campo] = [
                    'antes' => $original[$campo] ?? null,
                    'despues' => $valorNuevo
                ];
            }
            $nuevo['Cambios'] = $cambios;
        }
        if ($actuales !== [] && array_keys($actuales) !== range(0, count($actuales) - 1)) $actuales = [$actuales];
        $actuales[] = $nuevo;
        return $actuales;
    }

   
    public function Comite()
    {
        return $this->hasOne('App\Models\Comite', 'id', 'IdComiteDes');
    }    
}
