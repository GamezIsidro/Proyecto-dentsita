<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'slot_id',
        'motivo',
        'estado',
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

    public function paciente()
    {
        // Tu tabla de usuarios es 'users', así que 'paciente_id' debe apuntar a App\Models\User
        return $this->belongsTo(User::class, 'paciente_id');
    }
}
