<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Slot;
use App\Models\Cita;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class PantallaDoctorController extends Controller
{
    // 1) Mostrar formulario para que el doctor ingrese nuevas fechas/hora
    public function createFechas()
    {
        return view('doctor.fechas.crear');
    }

    // 2) Guardar nuevas fechas (slots) provenientes del formulario
public function storeFechas(Request $request)
{
    $validated = $request->validate([
        'fechas'   => 'required|array|min:1',
        'fechas.*' => 'date',
        'horas'    => 'required|array|min:1',
        'horas.*'  => 'date_format:H:i',
    ]);

    $doctor = Auth::guard('doctor')->user();
    if (! $doctor) {
        abort(403, 'No estás autenticado como doctor.');
    }

    foreach ($validated['fechas'] as $unaFecha) {
        foreach ($validated['horas'] as $unaHora) {
            $exists = Slot::where('doctor_id', $doctor->id)
                          ->where('fecha', $unaFecha)
                          ->where('hora',  $unaHora)
                          ->exists();
            if (! $exists) {
                Slot::create([
                    'doctor_id'  => $doctor->id,
                    'fecha'      => $unaFecha,
                    'hora'       => $unaHora,
                    'disponible' => 1,
                ]);
            }
        }
    }

    return redirect()
           ->route('doctor.fechas.index')
           ->with('success', 'Disponibilidades guardadas correctamente');
}



    // 3) Listar todos los slots del doctor autenticado
    public function indexFechas()
    {
        $doctor = Auth::guard('doctor')->user();
        $fechas = Slot::where('doctor_id', $doctor->id)
                      ->orderBy('fecha')
                      ->orderBy('hora')
                      ->get();

        return view('doctor.fechas.index', compact('fechas'));
    }

    public function destroyFecha($id)
{
    $doctor = Auth::guard('doctor')->user();
    if (! $doctor) {
        abort(403, 'No estás autenticado como doctor.');
    }

    // 1) Buscar el slot que el doctor intenta eliminar
    $slot = Slot::where('id', $id)
                ->where('doctor_id', $doctor->id)
                ->first();

    // 2) Si no existe o no pertenece a este doctor, abortar
    if (! $slot) {
        abort(404, 'Slot no encontrado o no tienes permiso para eliminarlo.');
    }

    // 3) Si existe, lo borramos
    $slot->delete();

    // 4) Volvemos a la lista con un mensaje de éxito
    return redirect()
           ->route('doctor.fechas.index')
           ->with('success', 'Hora eliminada correctamente');
}  
/**
 * 3) Listar todas las Citas que dependen de esos slots
 */
public function indexCitas()
{
    $doctor = Auth::guard('doctor')->user();
    if (! $doctor) {
        abort(403, 'No estás autenticado como doctor.');
    }

    // Recuperar solo aquellas citas cuyo slot pertenece a este doctor
    $citas = Cita::whereHas('slot', function($query) use ($doctor) {
                    $query->where('doctor_id', $doctor->id);
                })
                ->with(['slot', 'paciente'])
                ->orderByDesc('created_at')
                ->get();

    return view('doctor.citas.index', compact('citas'));
}

/**
 * 3.b) Cancelar (eliminar) una Cita
 */
public function destroyCita($id)
{
    $doctor = Auth::guard('doctor')->user();
    if (! $doctor) {
        abort(403, 'No estás autenticado como doctor.');
    }

    $cita = Cita::where('id', $id)
                ->whereHas('slot', function($query) use ($doctor) {
                    $query->where('doctor_id', $doctor->id);
                })
                ->first();

    if (! $cita) {
        abort(404, 'Cita no encontrada o no tienes permiso para cancelarla.');
    }

    $cita->delete();

    return redirect()
           ->route('doctor.citas.index')
           ->with('success', 'Cita cancelada correctamente');
}

 public function createDoctor()
{
    $doctorAdmin = Auth::guard('doctor')->user();
    if (! $doctorAdmin) {
        abort(403, 'No estás autenticado como doctor.');
    }

    // ⚠️ Cambiamos “doctor.registro.nueva_doc” (sin “s” en “registro”)
    return view('doctor.registro.nueva_doc');
}

public function storeDoctor(Request $request)
{
    $doctorAdmin = Auth::guard('doctor')->user();
    if (! $doctorAdmin) {
        abort(403, 'No estás autenticado como doctor.');
    }

    $data = $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|unique:doctors,email',
        'password'  => 'required|string|min:6|confirmed',
        'specialty' => 'nullable|string|max:255',
    ]);

    Doctor::create([
        'name'      => $data['name'],
        'email'     => $data['email'],
        'password'  => Hash::make($data['password']),
        'specialty' => $data['specialty'] ?? null,
    ]);

    // ⚠️ Redirigimos a la ruta “doctor.registro.crear” (coincide con el nombre que pondremos en routes)
    return redirect()
           ->route('doctor.registro.crear')
           ->with('success', 'Doctora registrada correctamente');
}
}