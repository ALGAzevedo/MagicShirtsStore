<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Estampa extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $with = ['categoriaRef'];

    protected $fillable = [
        'cliente_id', 'categoria_id', 'nome', 'descricao', 'imagem_url',
        'informacao_extra'
    ];

    public function categoriaRef(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function tshirt(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tshirt::class, 'id', 'estampa_id');
    }

    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

}
