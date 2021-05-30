<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    use HasFactory;

    protected $fillable = [
        'encomenda_id', 'cor_codigo', 'tamanho', 'quantidade', 'preco_un', 'sub_total'
    ];

    public function estampa()
    {
        return $this->belongsTo(Estampa::class, 'estampa_id', 'id')->withTrashed();
    }

    public function cor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cor::class);
    }

    public function encomenda(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Encomenda::class);
    }
}
