<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Mensaje extends Model
{
	use HasFactory;
	
    public $timestamps = false;
    public const FOLDER = 'mensajes/';

    protected $table = 'mensajes';

    protected $fillable = ['titulo','fechaIni','fechaFin','foto',
        'contenido','documento','urlLink'];

    public function getFotoUrlAttribute()
    {
        return $this->foto
            ? Storage::url(self::FOLDER . $this->foto)
            : null;
    }      
    public function getDocUrlAttribute()
    {
        return $this->documento
            ? Storage::url(self::FOLDER . $this->documento)
            : null;
    }       
    public function getFotoSubidaUrlAttribute()
    {
        return $this->fotoSubida?->temporaryUrl();
    }	
    public function getDocSubidaUrlAttribute()
    {
        return $this->docSubida?->temporaryUrl();
    }    
}
