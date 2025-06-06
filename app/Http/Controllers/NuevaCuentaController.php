<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class NuevaCuentaController extends Controller
{
    public function index()
    {
        return view('nueva_cuenta'); // Muestra la vista
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'fecha_nac' => 'required|date',
            'telefono' => 'required|string|max:15',
            'enfermedades' => 'nullable|string',
            'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/\./',
        ]);

        // Guardar los datos en la base de datos
        User::create([
            'name' => $validated['nombre'],
            'email' => $validated['email'],
            'fecha_nac' => $validated['fecha_nac'],
            'telefono' => $validated['telefono'],
            'enfermedades' => $validated['enfermedades'],
            'password' => Hash::make($validated['password']),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('nueva_cuenta')->with('success', 'Cuenta creada correctamente.');
    }
}