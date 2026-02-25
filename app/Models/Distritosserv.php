<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distritosserv extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'distritosservs';

    protected $fillable = ['IdDistrito','IdServicio','IdComite','IdComiteCan','servidor','telefono','asamblea1','asamblea2'];

    public function scopeOrdenado($query)
    {
        return $query
            ->join('comites', 'comites.id', '=', 'distritosservs.IdComite')
            ->join('servicios', 'servicios.id', '=', 'distritosservs.IdServicio')
            ->orderBy('comites.orden')
            ->orderBy('servicios.orden')
            ->select('distritosservs.*');
    }

    public function getServidorCortoAttribute(): string
    {
        if (empty($this->servidor)) {
            return '';
        }
        $partes = preg_split('/\s+/u', trim($this->servidor));
        $nombre = $partes[0] ?? '';
        $inicial = isset($partes[1])
            ? ' ' . mb_strtoupper(mb_substr($partes[1], 0, 1))
            : '';
        return $nombre . $inicial;
    }    
    
    public function Servicio()
    {
        return $this->hasOne('App\Models\Servicio', 'id', 'IdServicio');
    } 
    public function Comite()
    {
        return $this->hasOne('App\Models\Comite', 'id', 'IdComite');
    }    
    public function ComiteCanalizado()
    {
        return $this->hasOne('App\Models\Comite', 'id', 'IdComiteCan');
    }          
}
