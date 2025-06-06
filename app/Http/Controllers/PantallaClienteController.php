<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\Cita;
use App\Models\Slot;
use App\Models\User;

class PantallaClienteController extends Controller
{
    /**
     * 1) Mostrar formulario de creación de cita
     */
    public function crear()
    {
        // 1) Obtener el usuario autenticado (paciente)
        $paciente = Auth::user();
        if (! $paciente) {
            abort(403, 'No estás autenticado como paciente.');
        }

        // 2) Obtener todos los slots disponibles (disponible = 1) y no ocupados
        $slots = Slot::where('disponible', 1)
                     ->orderBy('fecha')
                     ->orderBy('hora')
                     ->get();

        // 3) Retornar la vista pasando tanto $slots como $paciente
        return view('cliente.crear', compact('slots', 'paciente'));
    }

    /**
     * 1.b) Almacenar la nueva cita
     */
       public function store(Request $request)
    {
        $validated = $request->validate([
            'slot_id' => 'required|exists:slots,id',
            'motivo'  => 'required|string|max:255',
        ]);

        $paciente = Auth::user();
        if (! $paciente) {
            abort(403, 'No estás autenticado como paciente.');
        }

        // Verificar que el slot siga libre
        $slot = Slot::findOrFail($validated['slot_id']);
        if (! $slot->disponible) {
            return back()->withErrors(['mensaje' => 'El slot ya no está disponible']);
        }

        // Intentamos crear la cita. Si existe ya una (índice único paciente_id),
        // capturamos la excepción y redirigimos con mensaje en sesión.
        try {
            Cita::create([
                'paciente_id' => $paciente->id,
                'slot_id'     => $slot->id,
                'motivo'      => $validated['motivo'],
                'estado'      => 'pendiente',
            ]);
        } catch (QueryException $e) {
            // Código SQLSTATE 23000 es violación de integridad; el número exacto puede variar.
            // Verificamos que sea 'duplicate entry' en paciente_id:
            if (str_contains($e->getMessage(), 'Duplicate entry') &&
                str_contains($e->getMessage(), 'paciente_id')) {
                return back()->with('error', 'Ya tienes una cita pendiente. No puedes generar otra hasta que la canceles o termine.');
            }
            // Si es otro error, relanzamos para no ocultar errores inesperados:
            throw $e;
        }

        // Marcar el slot como no disponible solo si la creación de cita fue exitosa
        $slot->update(['disponible' => 0]);

        return redirect()
               ->route('cliente.citas')
               ->with('success', 'Cita creada correctamente');
    }

    /**
     * 2) Listar todas las citas del paciente autenticado
     */
    public function citas()
    {
        $paciente = Auth::user();
        if (! $paciente) {
            abort(403, 'No estás autenticado como paciente.');
        }

        $citas = Cita::where('paciente_id', $paciente->id)
                     ->with('slot.doctor')
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('cliente.citas', compact('citas'));
    }

    /**
     * 3) Mostrar perfil del paciente
     */
    public function perfil()
    {
        $paciente = Auth::user();
        if (! $paciente) {
            abort(403, 'No estás autenticado como paciente.');
        }

        return view('cliente.perfil', compact('paciente'));
    }

    /**
     * 3.b) Actualizar datos de perfil del paciente
     */
    public function update(Request $request)
    {
        $paciente = Auth::user();
        if (! $paciente) {
            abort(403, 'No estás autenticado como paciente.');
        }

        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $paciente->id,
            'fecha_nac'    => 'nullable|date',
            'telefono'     => 'nullable|string|max:20',
            'enfermedades' => 'nullable|string',
            'password'     => 'nullable|string|min:6|confirmed',
        ]);

        if (! empty($data['password'])) {
            $paciente->password = Hash::make($data['password']);
        }

        $paciente->name         = $data['name'];
        $paciente->email        = $data['email'];
        $paciente->fecha_nac    = $data['fecha_nac'];
        $paciente->telefono     = $data['telefono'];
        $paciente->enfermedades = $data['enfermedades'] ?? $paciente->enfermedades;
        $paciente->save();

        return redirect()
               ->route('cliente.perfil')
               ->with('success', 'Perfil actualizado correctamente');
    }
}
