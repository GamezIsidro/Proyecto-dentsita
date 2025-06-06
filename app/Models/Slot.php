<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor; // recuerda importar el modelo Doctor

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'fecha',
        'hora',
        'disponible',
    ];

    /**
     * Relación: un Slot pertenece a un Doctor
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * (Opcional) Relación: un Slot puede tener muchas Citas
     */
    public function citas()
    {
        return $this->hasMany(Cita::class, 'slot_id');
    }
}
