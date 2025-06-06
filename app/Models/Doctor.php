<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'specialty',
    ];

    // Si quieres, puedes declarar la relación inversa:
    public function slots()
    {
        return $this->hasMany(Slot::class, 'doctor_id');
    }
}
