<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;

    //Overrides table name
    protected $table = 'cores';

    protected $primaryKey = 'codigo';

    protected $keyType = 'string';

    public function tshirt(){

        return $this->hasMany(Tshirt::class);
    }
}
