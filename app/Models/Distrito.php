<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'distritos';

    protected $fillable = ['distrito','panel','orden','direccion','telefono','foto','gmaps','ubicacion','fechaHPle','fechaHEst','fechaHSer','fechaHEva','obs','adicionales','porcionGeo'];
    public function Mcd()
    {
        return $this->hasOne(Distritosserv::class, 'IdDistrito', 'id')
                    ->where('IdServicio', 6);
    }

    public function Grupos()
    {
        return $this->hasMany('App\Models\Grupo', 'IdDistrito', 'id');
    }
    public function Distritosserv()
    {
        return $this->hasMany('App\Models\Distritosserv', 'IdDistrito', 'id');
    }
}
