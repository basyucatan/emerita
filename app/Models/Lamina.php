<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamina extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'laminas';

    protected $fillable = ['lamina','codigo','codigoCinta','pesoML','calibre','dUtil'];
	
    public function modelospres()
    {
        return $this->hasMany('App\Models\Modelospre', 'IdLamina', 'id');
    }
    
}
