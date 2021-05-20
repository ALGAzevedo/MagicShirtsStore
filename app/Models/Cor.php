<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;

    //Overrides table name
    protected $table = 'cores';

    public function tshirt(){

        return $this->hasMany(Tshirt::class);
    }
}
