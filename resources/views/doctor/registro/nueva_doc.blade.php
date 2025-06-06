{{-- resources/views/doctor/registro/nueva_doc.blade.php --}}
@extends('layouts.doc')

@section('title', 'Registrar Doctora')

@section('content')
  {{-- Alpine.js si lo necesitas --}}
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <div class="min-h-screen bg-gradient-to-tr from-blue-900 to-cyan-600 flex items-center justify-center p-6">
    <div class="w-full max-w-2xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">
      <h2 class="text-4xl font-extrabold text-cyan-300 mb-6 text-center">
        ✧ Registrar Doctora ✧
      </h2>

      {{-- Mensaje de éxito --}}
      @if(session('success'))
        <div class="mb-6 p-4 bg-blue-500 bg-opacity-30 text-white rounded-lg text-center">
          {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="{{ route('doctor.registro.store') }}" class="space-y-8">
        @csrf

        {{-- Nombre --}}
        <div>
          <label for="name" class="block text-lg font-semibold text-cyan-200 mb-2">
            Nombre completo:
          </label>
          <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="Ej: Dra. María Pérez"
            required
          >
          @error('name')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- Correo --}}
        <div>
          <label for="email" class="block text-lg font-semibold text-cyan-200 mb-2">
            Correo electrónico:
          </label>
          <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="ejemplo@clinica.test"
            required
          >
          @error('email')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- Contraseña --}}
        <div>
          <label for="password" class="block text-lg font-semibold text-cyan-200 mb-2">
            Contraseña:
          </label>
          <input
            type="password"
            id="password"
            name="password"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="Mínimo 6 caracteres"
            required
          >
          @error('password')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- Confirmar contraseña --}}
        <div>
          <label for="password_confirmation" class="block text-lg font-semibold text-cyan-200 mb-2">
            Confirmar contraseña:
          </label>
          <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="Repite la contraseña"
            required
          >
          @error('password_confirmation')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- Especialidad --}}
        <div>
          <label for="specialty" class="block text-lg font-semibold text-cyan-200 mb-2">
            Especialidad (opcional):
          </label>
          <input
            type="text"
            id="specialty"
            name="specialty"
            value="{{ old('specialty') }}"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
            placeholder="Ej: Ortodoncia, Endodoncia..."
          >
          @error('specialty')
            <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
          @enderror
        </div>

        {{-- Botón de “Registrar” --}}
        <div class="flex justify-center">
          <button
            type="submit"
            class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg transition-all duration-200"
          >
            Registrar Doctora
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
