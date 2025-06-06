{{-- resources/views/doctor/fechas/crear.blade.php --}}
@extends('layouts.doc')

@section('content')
    {{-- Cargamos Alpine.js para la parte reactiva --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div class="min-h-screen bg-gradient-to-tr from-blue-900 to-cyan-600 flex items-center justify-center p-6">
        {{-- Panel glass --}}
        <div class="w-full max-w-3xl bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-8">
            {{-- Título --}}
            <h2 class="text-4xl font-extrabold text-white mb-6 text-center tracking-wide">
                ✧ Crear Fechas y Horarios Disponibles ✧
            </h2>

            @if(session('success'))
                <div class="mb-6 p-4 bg-blue-800/40 text-white rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form 
                action="{{ route('doctor.fechas.store') }}" 
                method="POST" 
                x-data="{
                    newDate: '',
                    fechas: @json(old('fechas', [])),
                    hours: ['08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'],
                    selectedHoras: @json(old('horas', [])),
                    selectAll: false,
                    addDate() {
                        if (!this.newDate) return;
                        if (!this.fechas.includes(this.newDate)) {
                            this.fechas.push(this.newDate);
                        }
                        this.newDate = '';
                    },
                    removeDate(index) {
                        this.fechas.splice(index, 1);
                    },
                    toggleAll() {
                        if (this.selectAll) {
                            this.selectedHoras = [...this.hours];
                        } else {
                            this.selectedHoras = [];
                        }
                    },
                    checkIndividual() {
                        this.selectAll = (this.selectedHoras.length === this.hours.length);
                    }
                }" 
                class="space-y-8"
            >
                @csrf

                {{-- 1) Selección Dinámica de Fechas --}}
                <div>
                    <label class="block text-lg font-semibold text-cyan-200 mb-2">
                        Selecciona fecha(s):
                    </label>
                    <div class="flex items-center gap-3 mb-2">
                        <input 
                            type="date" 
                            x-model="newDate" 
                            min="{{ date('Y-m-d') }}"
                            class="w-full bg-white/20 backdrop-blur-sm border border-cyan-200/30 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition"
                        />
                        <button 
                            type="button" 
                            @click.prevent="addDate()"
                            class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-lg transition-all duration-200 ease-in-out"
                        >
                            Añadir Fecha
                        </button>
                    </div>
                    <template x-if="fechas.length === 0">
                        <p class="text-white text-sm italic">No hay fechas seleccionadas.</p>
                    </template>
                    <ul class="mt-4 space-y-2">
                        <template x-for="(fecha, idx) in fechas" :key="idx">
                            <li class="flex justify-between items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 text-white">
                                <span x-text="fecha" class="font-medium"></span>
                                <div class="flex items-center space-x-2">
                                    <input type="hidden" name="fechas[]" :value="fecha" />
                                    <button 
                                        type="button" 
                                        @click.prevent="removeDate(idx)"
                                        class="text-red-400 hover:text-red-300 text-xl font-bold"
                                        title="Eliminar fecha"
                                    >
                                        &times;
                                    </button>
                                </div>
                            </li>
                        </template>
                    </ul>
                    @error('fechas')
                        <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
                    @enderror
                    @error('fechas.*')
                        <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 2) Selección de Horas con “Seleccionar Todos” --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-lg font-semibold text-cyan-200">
                            Selecciona los horarios disponibles (08:00 – 17:00):
                        </label>
                        <div class="flex items-center space-x-1">
                            <input 
                                type="checkbox" 
                                id="select-all" 
                                x-model="selectAll" 
                                @change="toggleAll()"
                                class="h-5 w-5 text-cyan-300 bg-white/20 border-white rounded focus:ring-2 focus:ring-cyan-300"
                            />
                            <label for="select-all" class="text-white select-none text-sm">Seleccionar todos</label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        <template x-for="hora in hours" :key="hora">
                            <div class="flex items-center">
                                <input 
                                    type="checkbox"
                                    :id="'hora-' + hora.replace(':','')" 
                                    name="horas[]" 
                                    :value="hora"
                                    x-model="selectedHoras" 
                                    @change="checkIndividual()"
                                    class="h-5 w-5 text-cyan-300 bg-white/20 border-white rounded focus:ring-2 focus:ring-cyan-300"
                                />
                                <label 
                                    :for="'hora-' + hora.replace(':','')" 
                                    class="ml-2 text-white select-none"
                                >
                                    <span x-text="hora"></span>
                                </label>
                            </div>
                        </template>
                    </div>
                    @error('horas')
                        <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
                    @enderror
                    @error('horas.*')
                        <p class="mt-2 text-red-300 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 3) Botón de Envío Centrado --}}
                <div class="flex justify-center">
                    <button 
                        type="submit" 
                        class="bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-500 hover:to-blue-600 text-white font-semibold px-8 py-3 rounded-2xl shadow-lg transition-all duration-200 ease-in-out"
                    >
                        Guardar Disponibilidades
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
