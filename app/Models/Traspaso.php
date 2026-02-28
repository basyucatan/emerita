<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traspaso extends Model
{
    use HasFactory;

    protected $table = 'traspasos';
    public $timestamps = true;
    protected $fillable = [
        'tipo', 'IdUserOri', 'IdUserDes', 'IdDeptoOri', 'IdDeptoDes',
        'fecha', 'estatus', 'adicionales'
    ];
    protected $casts = ['adicionales' => 'array'];
    public function getTotalAttribute()
    {
        return $this->traspasosdets->sum(function ($row) {
            $importe = $row->Valores['importeMXN'] ?? 0;
            return $importe;
        });
    }

    public function deptoDes() { return $this->belongsTo(Depto::class, 'IdDeptoDes'); }
    public function deptoOri() { return $this->belongsTo(Depto::class, 'IdDeptoOri'); }
    public function traspasosdets() { return $this->hasMany(Traspasosdet::class, 'IdTraspaso'); }
    public function userOri() { return $this->belongsTo(User::class, 'IdUserOri'); }
    public function userDes() { return $this->belongsTo(User::class, 'IdUserDes'); }
}
