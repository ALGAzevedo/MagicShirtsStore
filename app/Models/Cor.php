<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cor extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $timestamps = false;

    //Overrides table name
    protected $table = 'cores';

    protected $primaryKey = 'codigo';

    protected $keyType = 'string';

    protected $fillable = [
        'nome', 'codigo'
    ];

    public function tshirt(){

        return $this->hasMany(Tshirt::class);
    }
}
