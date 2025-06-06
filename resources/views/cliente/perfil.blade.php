{{-- resources/views/cliente/perfil.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
  {{-- Alpine.js (solo si necesitas interactividad adicional) --}}
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <div class="min-h-screen bg-gradient-to-tr from-blue-900 to-cyan-600 flex items-center justify-center p-6">
    <div class="w-full max-w-4xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">
      <h2 class="text-4xl font-extrabold text-cyan-300 mb-6 text-center tracking-wide">
        ✧ Editar mi perfil ✧
      </h2>

      {{-- Mensaje de éxito --}}
      @if(session('success'))
        <div class="mb-6 p-4 bg-blue-500 bg-opacity-30 text-white rounded-lg text-center">
          {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="{{ route('cliente.perfil.update') }}" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- 1) Nombre completo --}}
        <div>
          <label for="name" class="block text-lg font-semibold text-cyan-200 mb-2">
            Nombre completo:
          </label>
          <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $paciente->name) }}"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
          >
          @error('name')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- 2) Correo electrónico --}}
        <div>
          <label for="email" class="block text-lg font-semibold text-cyan-200 mb-2">
            Correo electrónico:
          </label>
          <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $paciente->email) }}"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
          >
          @error('email')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- 3) Fecha de nacimiento --}}
        <div>
          <label for="fecha_nac" class="block text-lg font-semibold text-cyan-200 mb-2">
            Fecha de nacimiento:
          </label>
          <input
            type="date"
            id="fecha_nac"
            name="fecha_nac"
            value="{{ old('fecha_nac', $paciente->fecha_nac?->format('Y-m-d')) }}"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
          >
          @error('fecha_nac')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- 4) Teléfono --}}
        <div>
          <label for="telefono" class="block text-lg font-semibold text-cyan-200 mb-2">
            Teléfono:
          </label>
          <input
            type="text"
            id="telefono"
            name="telefono"
            value="{{ old('telefono', $paciente->telefono) }}"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="Ej: 123456789"
          >
          @error('telefono')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- 5) Enfermedades --}}
        <div>
          <label for="enfermedades" class="block text-lg font-semibold text-cyan-200 mb-2">
            Enfermedades (opcional):
          </label>
          <textarea
            id="enfermedades"
            name="enfermedades"
            rows="3"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="Describe alguna condición médica..."
          >{{ old('enfermedades', $paciente->enfermedades) }}</textarea>
          @error('enfermedades')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- 6) Nueva contraseña --}}
        <div>
          <label for="password" class="block text-lg font-semibold text-cyan-200 mb-2">
            Nueva contraseña:
          </label>
          <input
            type="password"
            id="password"
            name="password"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="Deja en blanco para no cambiar"
          >
          @error('password')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- 7) Confirmar contraseña --}}
        <div>
          <label for="password_confirmation" class="block text-lg font-semibold text-cyan-200 mb-2">
            Confirmar contraseña:
          </label>
          <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="Repite la nueva contraseña"
          >
          @error('password_confirmation')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- Botón “Guardar cambios” --}}
        <div class="flex justify-center">
          <button
            type="submit"
            class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg transition-all duration-200"
          >
            Guardar cambios
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
