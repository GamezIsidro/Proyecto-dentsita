{{-- resources/views/doctor/citas/index.blade.php --}}
@extends('layouts.doc')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div class="min-h-screen bg-gradient-to-tr from-blue-900 to-cyan-600 flex items-center justify-center p-6">
        {{-- Panel glass --}}
        <div class="w-full max-w-4xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">
            <h2 class="text-4xl font-extrabold text-white mb-6 text-center tracking-wide">
                ✧ Citas agendadas ✧
            </h2>

            {{-- Mensaje de éxito con fondo azul semitransparente --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-blue-500 bg-opacity-30 text-white rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if($citas->isEmpty())
                <p class="text-center text-cyan-200 text-lg">
                    No hay citas agendadas todavía.
                </p>
            @else
                <ul class="space-y-6">
                    @foreach($citas as $cita)
                        <li 
                            class="bg-blue-800/40 backdrop-blur-sm border border-blue-400/50 rounded-2xl p-5 flex justify-between items-start transition-all duration-200 ease-in-out hover:ring-2 hover:ring-cyan-300"
                        >
                            <div class="space-y-1">
                                {{-- Fecha y hora del slot --}}
                                <p class="text-sm text-cyan-200">
                                    {{ \Carbon\Carbon::parse($cita->slot->fecha)->format('l, d F Y') }}
                                    — {{ \Carbon\Carbon::parse($cita->slot->hora)->format('H:i') }}
                                </p>
                                {{-- Nombre del paciente --}}
                                <p class="text-lg font-semibold text-white">
                                    Paciente: {{ $cita->paciente->name }}
                                </p>
                                {{-- Motivo --}}
                                <p class="text-cyan-200">
                                    <span class="font-semibold">Motivo:</span>
                                    <span class="text-white">{{ $cita->motivo }}</span>
                                </p>
                            </div>

                            {{-- Botón cancelar cita (DELETE) --}}
                            <form 
                                action="{{ route('doctor.citas.destroy', $cita->id) }}" 
                                method="POST" 
                                x-data 
                                onsubmit="return confirm('¿Cancelar esta cita?');"
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
        </div>
    </div>
@endsection
