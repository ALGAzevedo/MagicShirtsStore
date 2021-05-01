<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function estampa()
    {
        return $this->hasMany(Estampa::class, 'id', 'cliente_id');
    }
}
