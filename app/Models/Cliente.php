<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id')->withTrashed();
    }

    public function estampa(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Estampa::class, 'id', 'cliente_id');
    }

    public function encomenda(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Encomenda::class);
    }
}
