<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depto extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'deptos';

    protected $fillable = ['depto'];
	

    public function movInvSalidas()
    {
        return $this->hasMany('App\Models\Movinventario', 'IdOrigen', 'id');
    }
    

    public function movInvEntradas()
    {
        return $this->hasMany('App\Models\Movinventario', 'IdDestino', 'id');
    }
    
}
