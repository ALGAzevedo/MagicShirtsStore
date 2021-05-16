<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tshirt(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tshirt::class);
    }

}
