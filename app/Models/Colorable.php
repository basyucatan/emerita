<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colorable extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'colorables';

    protected $fillable = ['colorable','tipo'];
	
}
