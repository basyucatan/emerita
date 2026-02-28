<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vidrio extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'vidrios';

    protected $fillable = ['vidrio','grosor'];
	
    public function materialscostos()
    {
        return $this->hasMany('App\Models\Materialscosto', 'IdVidrio', 'id');
    }
    
    public function modelospres()
    {
        return $this->hasMany('App\Models\Modelospre', 'IdVidrio', 'id');
    }
    
    public function presupuestos()
    {
        return $this->hasMany('App\Models\Presupuesto', 'IdVidrio', 'id');
    }
    
}
