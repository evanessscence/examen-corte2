<x-app-layout>
    {{-- Slot del encabezado de la página --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            {{-- Título principal --}}
            <h2 class="font-bold text-2xl text-gray-900 tracking-tight">
                {{ __('Ciudades') }}
            </h2>

            {{-- Botones de acción: Crear ciudad y Generar PDF --}}
            <div class="flex items-center gap-3">
                {{-- Botón para crear una nueva ciudad --}}
                <a href="{{ route('cities.create') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Crear ciudad
                </a>

                {{-- Botón para generar el PDF del listado de ciudades --}}
                <a href="{{ route('cities.pdf') }}"
                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0-2.21-1.79-4-4-4S4 8.79 4 11s1.79 4 4 4 4-1.79 4-4zm1 0h7m0 0l-3-3m3 3l-3 3" />
                    </svg>
                    Generar PDF
                </a>
            </div>
        </div>
    </x-slot>

    {{-- Contenido principal --}}
    <div class="py-8 max-w-4xl mx-auto">
        {{-- Listado de tarjetas de ciudades --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($cities as $city)
                {{-- Tarjeta individual de ciudad --}}
                <div class="bg-white shadow-lg ring-1 ring-gray-200 rounded p-6 flex flex-col justify-between transition duration-200 hover:shadow-2xl hover:ring-blue-400 hover:scale-105">
                    <div>
                        {{-- Nombre de la ciudad --}}
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $city->name }}</h3>
                        {{-- Descripción de la ciudad --}}
                        <p class="text-gray-600 mb-4">{{ $city->description }}</p>
                    </div>

                    {{-- Acciones: Editar y Eliminar --}}
                    <div class="flex justify-end space-x-4">
                        {{-- Enlace para editar la ciudad --}}
                        <a href="{{ route('cities.edit', $city->id) }}"
                            class="text-indigo-600 hover:text-indigo-900 font-medium">
                            {{ __('Editar') }}
                        </a>

                        {{-- Confirmación de eliminación (doble paso) --}}
                        @if (request('delete') == $city->id)
                            {{-- Formulario para confirmar eliminación --}}
                            <form action="{{ route('cities.destroy', $city->id) }}" method="POST" class="flex space-x-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    {{ __('Confirmar') }}
                                </button>
                                <a href="{{ route('cities.index') }}"
                                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                    {{ __('Cancelar') }}
                                </a>
                            </form>
                        @else
                            {{-- Enlace para mostrar botón de confirmación de eliminación --}}
                            <a href="{{ route('cities.index', ['delete' => $city->id]) }}"
                                class="text-red-600 hover:text-red-900 font-medium">
                                {{ __('Eliminar') }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        <div class="mt-6">
            {{ $cities->links() }}
        </div>
    </div>
</x-app-layout>