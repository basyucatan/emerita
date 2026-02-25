<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidosdet extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'pedidosdets';

    protected $fillable = ['IdPedido','IdProducto','cantidad','precioU'];
	
    public function pedido()
    {
        return $this->hasOne('App\Models\Pedido', 'id', 'IdPedido');
    }
    public function Producto()
    {
        return $this->belongsTo(Producto::class, 'IdProducto');
    }

}
