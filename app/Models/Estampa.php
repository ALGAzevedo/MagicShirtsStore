<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estampa extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $with = ['categoriaRef'];

    public function categoriaRef(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function tshirt()
    {
        return $this->hasMany(Tshirt::class, 'id', 'estampa_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

}
