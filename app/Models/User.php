<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Cita;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'fecha_nac',
        'telefono',
        'enfermedades',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'fecha_nac'         => 'date',
        ];
    }

    /**
     * Relación con citas (1 paciente puede tener muchas citas).
     */
    public function citas()
    {
        return $this->hasMany(Cita::class, 'paciente_id');
    }
}
