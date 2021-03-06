<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;
    use softDeletes;
    public $timestamps = false;

    protected $fillable = [
        'nome'
    ];

    public function estampas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Estampa::class, 'id', 'categoria_id');
    }
}
