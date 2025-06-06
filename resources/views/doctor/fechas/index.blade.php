{{-- resources/views/doctor/fechas/index.blade.php --}}
@extends('layouts.doc') {{-- Cambiado de layouts.app a layouts.doc --}}

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div 
        class="min-h-screen bg-gradient-to-tr from-blue-900 to-cyan-600 flex items-center justify-center p-6"
    >
        {{-- Panel glass --}}
        <div class="w-full max-w-4xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">
            <h2 class="text-4xl font-extrabold text-white mb-6 text-center tracking-wide">
                ✧ Mis fechas  ✧
            </h2>

            @if(session('success'))
            <div class="mb-6 p-4 bg-blue-800/40 text-white rounded-lg text-center">
                {{ session('success') }}
            </div>
            @endif


            @if($fechas->isEmpty())
                <p class="text-center text-cyan-200 text-lg">
                    Aún no tienes fechas programadas.
                </p>
            @else
                <ul class="space-y-6">
                    @foreach($fechas as $fecha)
                        <li 
                            class="bg-blue-800/40 backdrop-blur-sm border border-blue-400/50 rounded-2xl p-5 flex justify-between items-center transition-all duration-200 ease-in-out hover:ring-2 hover:ring-cyan-300"
                        >
                            <div>
                                <p class="text-sm text-cyan-200">
                                    {{ \Carbon\Carbon::parse($fecha->fecha)->format('l, d F Y') }}
                                </p>
                                <p class="mt-1 text-2xl font-semibold text-white">
                                    {{ \Carbon\Carbon::parse($fecha->hora)->format('H:i') }}
                                </p>
                            </div>
                            
                            <form 
                                action="{{ route('doctor.fechas.destroy', $fecha->id) }}" 
                                method="POST" 
                                x-data 
                                onsubmit="return confirm('¿Eliminar esta fecha?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="text-red-400 hover:text-red-600 transition duration-200"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- Botón rápido para crear nueva fecha --}}
            <div class="mt-8 text-center">
                <a 
                    href="{{ route('doctor.fechas.crear') }}"
                    class="inline-block bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-lg transition-all duration-200 ease-in-out"
                >
                    + Nueva fecha
                </a>
            </div>
        </div>
    </div>
@endsection
