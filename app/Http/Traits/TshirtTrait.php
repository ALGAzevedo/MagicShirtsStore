<?php

namespace App\Http\Traits;

use App\Models\Cor;
use App\Models\Estampa;

trait TshirtTrait {
    public function tshirtSizes(){
        return ['XS','S','M','L','XL'];
    }
}
