<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
	use HasFactory;
	
    public $timestamps = false;

    protected $table = 'comites';

    protected $fillable = ['comite','abreviatura','orden','comAsamblea'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function curriculas()
    {
        return $this->hasMany('App\Models\Curricula', 'IdComiteAsamblea', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inquietuds()
    {
        return $this->hasMany('App\Models\Inquietud', 'IdComiteDes', 'id');
    }
    
}
