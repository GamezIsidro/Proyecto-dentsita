<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Iniciar Sesión</title>
  {{-- Tailwind CSS --}}
  <script src="https://cdn.tailwindcss.com/3.3.0"></script>
</head>
<body class="bg-gradient-to-tr from-blue-900 to-cyan-600 min-h-screen flex items-center justify-center p-4 font-sans">

  <div class="w-full max-w-md bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">
    {{-- Título --}}
    <h1 class="text-3xl font-extrabold text-cyan-300 mb-6 text-center tracking-wide">
      Consultorio  Liera 
    </h1>
     
    <div class="flex justify-center mb-6">
      <img
        src="{{ asset('img/dientes.jpg') }}"
        alt="Dientes"
        class="w-20 h-20 rounded-full shadow-lg animate-fade-in-up"
      />
    </div>

    {{-- Mensajes de alerta --}}
    @if(session('no_user'))
      <div class="mb-4 p-3 bg-yellow-200 text-yellow-800 rounded-lg">
        {{ session('no_user') }}
        <a href="{{ route('nueva_cuenta') }}" class="ml-2 text-blue-600 underline">Crear cuenta</a>
      </div>
    @endif

    @if(session('info'))
      <div class="mb-4 p-3 bg-green-200 text-green-800 rounded-lg">
        {{ session('info') }}
      </div>
    @endif

    {{-- Formulario de login --}}
    <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-cyan-200 mb-1">Correo Electrónico:</label>
        <input
          type="email"
          id="email"
          name="email"
          value="{{ old('email') }}"
          required
          class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
        />
        @error('email')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password" class="block text-cyan-200 mb-1">Contraseña:</label>
        <input
          type="password"
          id="password"
          name="password"
          required
          class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white placeholder-cyan-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
        />
        @error('password')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="text-center">
        <button
          type="submit"
          class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg transition transform hover:scale-105 duration-200"
        >
          CONTINUAR
        </button>
      </div>
    </form>

    {{-- Link a registrar --}}
    <p class="mt-6 text-center text-cyan-200">
      ¿No tienes cuenta?
      <a href="{{ route('nueva_cuenta') }}" class="underline text-white hover:text-cyan-100">
        Crear una
      </a>
    </p>
  </div>

  {{-- Animaciones personalizadas --}}
  <style>
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
      animation: fade-in-up 1s ease-out;
    }
  </style>
</body>
</html>
