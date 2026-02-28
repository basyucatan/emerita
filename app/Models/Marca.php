<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'marcas';

    protected $fillable = ['marca','IdColorable','foto'];

    public function Colorable()
    {
        return $this->hasOne('App\Models\Colorable', 'id', 'IdColorable');
    }
    public function lineas()
    {
        return $this->hasMany('App\Models\Linea', 'IdMarca', 'id');
    }    
}
