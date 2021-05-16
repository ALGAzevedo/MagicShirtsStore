<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cliente_id', 'estado', 'data', 'preco_total', 'notas', 'nif', 'endereco',
        'tipo_pagamento', 'ref_pagamento', 'recibo_url'
    ];

    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tshirt(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tshirt::class);
    }

}
