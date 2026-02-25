<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'grupos';

    protected $fillable = ['IdDistrito','grupo','miembros','mujeres',
        'discapacitados','LGBTQyMas','direccion','localidad','tipo',
        'RSG','RSGSup','telefonoRSG','respCAsam','foto','gmaps',
        'ubicacion','IdComite','clase','Obs','asamblea1','asamblea2','vigente'];
	
    public function getRsgCortoAttribute(): string
    {
        if (empty($this->RSG)) {
            return '';
        }
        $partes = preg_split('/\s+/u', trim($this->RSG));
        $nombre = $partes[0] ?? '';
        $inicial = isset($partes[1])
            ? ' ' . mb_strtoupper(mb_substr($partes[1], 0, 1))
            : '';
        return $nombre . $inicial;
    }     
    public function Distrito()
    {
        return $this->hasOne('App\Models\Distrito', 'id', 'IdDistrito');
    }
    
}
