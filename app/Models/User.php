<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    use SoftDeletes;

    public $timestamps = false;


//    /**
//     * Overrides the method to ignore the remember token.
//     */
//    public function setAttribute($key, $value)
//    {
//        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
//        if (!$isRememberTokenAttribute)
//        {
//            parent::setAttribute($key, $value);
//        }
//    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'bloqueado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id', 'id');
    }
}
