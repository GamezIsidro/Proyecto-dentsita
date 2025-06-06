<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NuevaCuentaController;
use App\Http\Controllers\PantallaClienteController;
use App\Http\Controllers\PantallaDoctorController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/nueva_cuenta', [NuevaCuentaController::class, 'index'])->name('nueva_cuenta');
Route::post('/nueva_cuenta', [NuevaCuentaController::class, 'store'])->name('nueva_cuenta.store');


/*
|--------------------------------------------------------------------------
| Rutas Paciente (middleware auth:web)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:web')->group(function () {
    // 1) Mostrar formulario de creación de cita
    Route::get('/cliente/crear', [PantallaClienteController::class, 'crear'])
         ->name('cliente.crear');

    // 1.b) Procesar creación de cita
    Route::post('/cliente/crear', [PantallaClienteController::class, 'store'])
         ->name('cliente.store');

    // 2) Listar citas agendadas
    Route::get('/cliente/citas', [PantallaClienteController::class, 'citas'])
         ->name('cliente.citas');

    // 3) Ver y editar perfil de cliente
    Route::get('/cliente/perfil', [PantallaClienteController::class, 'perfil'])
         ->name('cliente.perfil');
    Route::put('/cliente/perfil', [PantallaClienteController::class, 'update'])
         ->name('cliente.perfil.update');
});


/*
|--------------------------------------------------------------------------
| Rutas Doctor (middleware auth:doctor)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:doctor')->group(function () {
    // Alias “pantalla.doctor” que redirige a “doctor.fechas.index”
    Route::get('/doctor', fn() => redirect()->route('doctor.fechas.index'))
         ->name('pantalla.doctor');

    // 1) Mostrar formulario para crear una nueva "Fecha" (slot)
    Route::get('/doctor/fechas/crear', [PantallaDoctorController::class, 'createFechas'])
         ->name('doctor.fechas.crear');

    // 1.b) Procesar creación de Fecha (slot)
    Route::post('/doctor/fechas', [PantallaDoctorController::class, 'storeFechas'])
         ->name('doctor.fechas.store');

    // 2) Listar todas las Fechas (slots) del doctor
    Route::get('/doctor/fechas', [PantallaDoctorController::class, 'indexFechas'])
         ->name('doctor.fechas.index');

    // 2.b) Eliminar una Fecha (slot)
    Route::delete('/doctor/fechas/{id}', [PantallaDoctorController::class, 'destroyFecha'])
         ->name('doctor.fechas.destroy');

    // 3) Listar todas las Citas que dependen de esos slots
    Route::get('/doctor/citas', [PantallaDoctorController::class, 'indexCitas'])
         ->name('doctor.citas.index');

    // 3.b) Cancelar (eliminar) una Cita
    Route::delete('/doctor/citas/{id}', [PantallaDoctorController::class, 'destroyCita'])
         ->name('doctor.citas.destroy');
     
         Route::get('/doctor/registro/nueva_doc', [PantallaDoctorController::class, 'createDoctor'])
         ->name('doctor.registro.crear');

    // Procesar registro de nuevo doctor
    Route::post('/doctor/registro', [PantallaDoctorController::class, 'storeDoctor'])
         ->name('doctor.registro.store');
});