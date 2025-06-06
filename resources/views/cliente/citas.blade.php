{{-- resources/views/cliente/citas/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Mis Citas')

@section('content')
  <div class="min-h-screen bg-gradient-to-tr from-blue-900 to-cyan-600 flex items-center justify-center p-6">
    <div class="w-full max-w-4xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">

      <h2 class="text-4xl font-extrabold text-cyan-300 mb-6 text-center">
        ✨ Mis Citas ✨
      </h2>

      {{-- Mensaje de éxito --}}
      @if(session('success'))
        <div class="mb-6 p-4 bg-blue-500 bg-opacity-30 text-white rounded-lg text-center">
          {{ session('success') }}
        </div>
      @endif

      @if($citas->isEmpty())
        <p class="text-center text-cyan-200 text-lg">
          No tienes citas agendadas.
        </p>
      @else
        <ul class="space-y-6">
          @foreach($citas as $cita)
            <li class="bg-blue-800/40 backdrop-blur-sm border border-blue-400/50 rounded-2xl p-6 flex flex-col md:flex-row justify-between items-start transition-all duration-200 ease-in-out hover:ring-2 hover:ring-cyan-300">
              <div class="space-y-1">
                {{-- Fecha y hora --}}
                <p class="text-sm text-cyan-200">
                  {{ \Carbon\Carbon::parse($cita->slot->fecha)->format('l, d F Y') }}
                  — {{ \Carbon\Carbon::parse($cita->slot->hora)->format('H:i') }}
                </p>
                {{-- Doctor --}}
                <p class="text-lg font-semibold text-white">
                  Doctor: {{ optional($cita->slot->doctor)->name ?? '—' }}
                </p>
                {{-- Motivo --}}
                <p class="text-cyan-200">
                  <span class="font-semibold">Motivo:</span>
                  <span class="text-white">{{ $cita->motivo }}</span>
                </p>
                {{-- Estado --}}
                <p class="text-cyan-200">
                  <span class="font-semibold">Estado:</span>
                  <span class="text-white">{{ ucfirst($cita->estado) }}</span>
                </p>
              </div>
            </li>
          @endforeach
        </ul>
      @endif

    </div>
  </div>
@endsection

