<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'guias';

    protected $fillable = ['guia','IdMaterial'];
	
    public function modelospres()
    {
        return $this->hasMany('App\Models\Modelospre', 'IdGuia', 'id');
    }
    
}
