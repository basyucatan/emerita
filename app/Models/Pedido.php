<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'pedidos';

    protected $fillable = ['IdUser','IdCliente','FechaH','total',
        'totalArticulos','estatus','Obs','adicionales'];
	protected $casts = ['adicionales' => 'array',];	

    public function Pedidosdets()
    {
        return $this->hasMany('App\Models\Pedidosdet', 'IdPedido', 'id');
    }
    public function getTotalAttribute()
    {
        return $this->Pedidosdets()
            ->select(DB::raw('COALESCE(SUM(cantidad * precioU), 0) as total'))
            ->value('total');
    }
    public function getTotalArtAttribute()
    {
        return $this->Pedidosdets()
            ->select(DB::raw('COALESCE(SUM(cantidad ), 0) as totalArt'))
            ->value('totalArt');
    }
    public function getDistritoAttribute()
    {
        $idDistrito = $this->adicionales['IdDistrito'] ?? null;
        if (!$idDistrito) {return null;}
        return Distrito::find($idDistrito);
    }
    public function getFondoPedAttribute()
    {
        return match ($this->estatus) {
            'CARRITO'     => '#FFF3CD', // amarillo
            'CONFIRMADO'  => '#CFE2FF', // azul
            'SURTIDO'     => '#D1E7DD', // verde
            'CANCELADO'   => '#F8D7DA', // rojo
            default       => '#FFFFFF',
        };
    }

}
