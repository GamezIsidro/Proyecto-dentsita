<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Crear Cuenta</title>
  {{-- Tailwind CSS --}}
  <script src="https://cdn.tailwindcss.com/3.3.0"></script>
</head>
<body class="bg-gradient-to-tr from-blue-900 to-cyan-600 min-h-screen flex items-center justify-center p-4 font-sans">

  <div class="w-full max-w-3xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8 space-y-6">
    <h1 class="text-4xl font-extrabold text-cyan-300 mb-4 text-center tracking-wide">
      ✧ CREAR CUENTA ✧
    </h1>

    <form 
      id="formCrear" 
      action="{{ route('nueva_cuenta.store') }}" 
      method="POST" 
      class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6 text-white text-lg"
    >
      @csrf

      {{-- Nombre --}}
      <label for="nombre" class="self-center">Nombre completo:</label>
      <input 
        type="text" 
        id="nombre" 
        name="nombre" 
        placeholder="Nombre completo"
        value="{{ old('nombre') }}" 
        required
        class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
      />
      @error('nombre')
        <p class="text-red-300 text-sm col-span-full">{{ $message }}</p>
      @enderror

      {{-- Correo --}}
      <label for="email" class="self-center">Correo electrónico:</label>
      <input 
        type="email" 
        id="email" 
        name="email" 
        placeholder="correo@ejemplo.com"
        value="{{ old('email') }}" 
        required
        class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
      />
      @error('email')
        <p class="text-red-300 text-sm col-span-full">{{ $message }}</p>
      @enderror

      {{-- Fecha de nacimiento --}}
      <label for="fecha_nac" class="self-center">Fecha de nacimiento:</label>
      <input 
        type="date" 
        id="fecha_nac" 
        name="fecha_nac" 
        value="{{ old('fecha_nac') }}" 
        required
        class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
      />
      @error('fecha_nac')
        <p class="text-red-300 text-sm col-span-full">{{ $message }}</p>
      @enderror

      {{-- Teléfono --}}
      <label for="telefono" class="self-center">Número de teléfono:</label>
      <input 
        type="tel" 
        id="telefono" 
        name="telefono" 
        placeholder="Número de teléfono"
        value="{{ old('telefono') }}" 
        required
        class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
      />
      @error('telefono')
        <p class="text-red-300 text-sm col-span-full">{{ $message }}</p>
      @enderror

      {{-- Enfermedades --}}
      <label for="enfermedades" class="self-start">Enfermedades (opcional):</label>
      <textarea 
        id="enfermedades" 
        name="enfermedades" 
        rows="3"
        placeholder="Describe si padeces alguna condición"
        class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
      >{{ old('enfermedades') }}</textarea>
      @error('enfermedades')
        <p class="text-red-300 text-sm col-span-full">{{ $message }}</p>
      @enderror

      {{-- Contraseña --}}
      <label for="password" class="self-center">Contraseña:</label>
      <input 
        type="password" 
        id="password" 
        name="password" 
        required
        placeholder="Mínimo 8 caracteres, al menos una MAYÚSCULA y un punto."
        pattern="(?=.*[A-Z])(?=.*\.).{8,}"
        class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
      />
      <p class="text-sm text-cyan-200 col-span-full">
        * Mínimo 8 caracteres, al menos una MAYÚSCULA y un punto.
      </p>
      @error('password')
        <p class="text-red-300 text-sm col-span-full">{{ $message }}</p>
      @enderror

      {{-- Confirmar contraseña --}}
      <label for="password_confirmation" class="self-center">Confirmar contraseña:</label>
      <input 
        type="password" 
        id="password_confirmation" 
        name="password_confirmation" 
        required
        placeholder="Repite la contraseña"
        class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
      />
      @error('password_confirmation')
        <p class="text-red-300 text-sm col-span-full">{{ $message }}</p>
      @enderror
    </form>

    {{-- Botones azules dentro del mismo cuadro --}}
    <div class="mt-6 flex flex-col md:flex-row justify-center gap-4">
      <button
        form="formCrear"
        type="submit"
        class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg transition transform hover:scale-105 duration-200"
      >
        CONTINUAR
      </button>
      <button
        onclick="location.href='{{ route('login') }}'"
        class="bg-gradient-to-r from-blue-500 to-cyan-400 hover:from-blue-600 hover:to-cyan-500 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg transition transform hover:scale-105 duration-200"
      >
        IR AL LOGIN
      </button>
    </div>
  </div>

</body>
</html>
