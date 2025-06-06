{{-- resources/views/layouts/cliente.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel Paciente – @yield('title', 'Dashboard')</title>

    {{-- Cargamos Tailwind via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            // Agrega aquí colores personalizados si lo deseas
          }
        }
      }
    </script>
</head>
<body class="antialiased bg-gray-900 text-white">
    {{-- Barra de navegación específica para los pacientes --}}
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0 text-2xl font-bold text-cyan-300">
                    Paciente Panel
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('cliente.crear') }}"
                           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-cyan-700">
                            Crear Cita
                        </a>
                        <a href="{{ route('cliente.citas') }}"
                           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-cyan-700">
                            Mis Citas
                        </a>
                        <a href="{{ route('cliente.perfil') }}"
                           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-cyan-700">
                            Perfil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-3 py-2 rounded-md text-sm font-medium hover:bg-cyan-700">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Aquí va el contenido de cada vista --}}
    <main>
        @yield('content')
    </main>
</body>
</html>
