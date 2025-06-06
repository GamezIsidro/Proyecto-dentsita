<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio | Citas Médicas</title>

  {{-- Tailwind CSS --}}
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-blue-900 to-cyan-600 min-h-screen flex items-center justify-center font-sans">
  {{-- Fondo principal con efecto “glass” --}}
  <div class="w-full max-w-2xl p-8 bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl animate-fade-in-down">
    <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 text-center animate-pulse">
      Bienvenido al Sistema de Citas Médicas
    </h1>

    <div class="mb-8 flex justify-center">
      <img
        src="{{ asset('img/home.jpeg') }}"
        alt="Dibujo de un dentista"
        class="w-64 rounded-xl shadow-lg animate-fade-in-up"
      />
    </div>

    <div class="flex flex-col md:flex-row justify-center gap-6">
      <a
        href="{{ route('login') }}"
        class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold py-3 px-8 rounded-2xl shadow-lg transition transform hover:scale-105 duration-300 text-center"
      >
        Iniciar Sesión
      </a>
      <a
        href="{{ route('nueva_cuenta') }}"
        class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-semibold py-3 px-8 rounded-2xl shadow-lg transition transform hover:scale-105 duration-300 text-center"
      >
        Registrarse
      </a>
    </div>
  </div>

  {{-- Animaciones personalizadas --}}
  <style>
    @keyframes fade-in-down {
      0% { opacity: 0; transform: translateY(-20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down {
      animation: fade-in-down 1s ease-out;
    }
    .animate-fade-in-up {
      animation: fade-in-up 1.2s ease-out;
    }
  </style>
</body>
</html>

