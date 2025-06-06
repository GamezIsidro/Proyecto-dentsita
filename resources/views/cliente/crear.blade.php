{{-- resources/views/cliente/crear.blade.php --}}
@extends('layouts.app')

@section('title', 'Crear cita')

@section('content')
<div class="min-h-screen bg-gradient-to-tr from-blue-900 to-cyan-600 flex items-center justify-center p-6">
  <div class="w-full max-w-3xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8 space-y-6">

    <h1 class="text-4xl font-extrabold text-cyan-300 mb-6 text-center">
      Bienvenido, {{ $paciente->name }}!
    </h1>

    {{-- 1) Mostrar mensaje de error “ya tienes cita pendiente” --}}
    @if (session('error'))
      <div class="mb-4 p-4 bg-red-600 bg-opacity-40 text-white rounded-lg">
        {{ session('error') }}
      </div>
    @endif

    {{-- 2) Mostrar mensaje de éxito --}}
    @if (session('success'))
      <div class="mb-4 p-4 bg-green-600 bg-opacity-40 text-white rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    @if ($slots->isEmpty())
      <p class="text-center text-gray-300">No hay slots disponibles por ahora.</p>
    @else
      <form action="{{ route('cliente.store') }}" method="POST" x-data="{ motivo: '{{ old('motivo') }}' }" class="space-y-8">
        @csrf

        {{-- Selección de Slots --}}
        <div>
          <h2 class="text-2xl font-semibold text-white mb-4 text-center">Elige un día y hora disponibles:</h2>
          <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($slots as $slot)
              <label class="cursor-pointer">
                <input 
                  type="radio" 
                  name="slot_id" 
                  value="{{ $slot->id }}" 
                  class="peer sr-only" 
                  {{ old('slot_id') == $slot->id ? 'checked' : '' }}
                />
                <div 
                  class="flex flex-col items-center justify-center p-4 bg-white/20 backdrop-blur-sm border border-cyan-300 rounded-2xl 
                         transition peer-checked:bg-cyan-600/50 peer-checked:border-cyan-500"
                >
                  <div class="text-white text-lg font-semibold">
                    {{ \Carbon\Carbon::parse($slot->fecha)->format('d/m/Y') }}
                  </div>
                  <div class="text-cyan-200 mt-1">
                    {{ \Carbon\Carbon::parse($slot->hora)->format('H:i') }}
                  </div>
                  <div class="text-white text-sm mt-2">
                    {{ optional($slot->doctor)->name ?? '—' }}
                  </div>
                  <div class="text-cyan-200 text-sm">
                    {{ optional($slot->doctor)->specialty ?? '—' }}
                  </div>
                </div>
              </label>
            @endforeach
          </div>
          @error('slot_id')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
          @enderror
        </div>

        {{-- Motivo --}}
        <div x-data>
          <label for="motivo" class="block text-white text-lg font-semibold mb-2">
            ¿Para qué es la cita?
          </label>
          <textarea 
            id="motivo" 
            name="motivo" 
            x-model="motivo"
            rows="4"
            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-300 rounded-2xl text-white p-4 focus:outline-none focus:ring-2 focus:ring-cyan-400 transition"
            placeholder="Descríbenos el motivo de tu cita..."
          >{{ old('motivo') }}</textarea>
          @error('motivo')
            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
          @enderror
        </div>

        {{-- Botón Enviar --}}
        <div class="flex justify-center">
          <button 
            type="submit"
            class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg transition-all duration-200"
          >
            Pedir cita
          </button>
        </div>
      </form>
    @endif

    {{-- Panel “Ver citas” rápido --}}
    <div class="mt-10 text-center">
      <a 
        href="{{ route('cliente.citas') }}"
        class="inline-block bg-gradient-to-r from-blue-500 to-cyan-400 hover:from-blue-600 hover:to-cyan-500 text-white font-semibold px-6 py-3 rounded-2xl shadow-lg transition-all duration-200"
      >
        Ver mis citas
      </a>
    </div>
  </div>
</div>
@endsection
