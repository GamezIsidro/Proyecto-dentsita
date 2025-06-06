{{-- resources/views/layouts/doc.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel Doctor - @yield('title', 'Dashboard')</title>

    {{-- Cargamos Tailwind via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            // Colores personalizados, si los necesitaras
          }
        }
      }
    </script>
</head>
<body class="antialiased bg-gray-900 text-white">
    {{-- Barra de navegación específica para los doctores --}}
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0 text-2xl font-bold text-cyan-300">
                    Doctor Panel
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('doctor.fechas.index') }}"
                           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-cyan-700">
                            Mis Fechas
                        </a>
                        <a href="{{ route('doctor.citas.index') }}"
                           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-cyan-700">
                            Mis Citas
                        </a>
                        <a href="{{ route('doctor.registro.crear') }}"
                           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-cyan-700">
                            Registrar Doctora
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
                {{-- Botón hamburguesa en móvil --}}
                <div class="-mr-2 flex md:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md hover:bg-cyan-700 focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Menú colapsable en pantallas pequeñas --}}
        <div class="md:hidden" x-data="{ open: false }" x-show="open" x-transition>
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('doctor.fechas.index') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium hover:bg-cyan-700">
                    Mis Fechas
                </a>
                <a href="{{ route('doctor.citas.index') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium hover:bg-cyan-700">
                    Mis Citas
                </a>
                <a href="{{ route('doctor.registro.crear') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium hover:bg-cyan-700">
                    Registrar Doctora
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-cyan-700">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Contenido de cada vista --}}
    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
