<!-- resources/views/livewire/period-management.blade.php -->
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">
            Gestión de Períodos
        </h2>
        <button
            wire:click="create"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
        >
            Nuevo Período
        </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Nombre
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Fecha Inicio
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Fecha Fin
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($periods as $period)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $period->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $period->start_date }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $period->end_date }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button
                            wire:click="edit({{ $period->id }})"
                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                        >
                            Editar
                        </button>
                        <button
                            wire:click="delete({{ $period->id }})"
                            class="text-red-600 hover:text-red-900 mr-3"
                        >
                            Eliminar
                        </button>
                        <button
                            wire:click="addSubject({{ $period->id }})"
                            class="text-lime-600 hover:text-lime-900"
                        >
                            ver
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($showModal)
    <div
        class="fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto flex items-center justify-center"
    >
        <div class="bg-white rounded-lg shadow-xl p-6 sm:w-full sm:max-w-md">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
                {{ $isEditing ? "Editar Período" : "Nuevo Período" }}
            </h3>

            <form wire:submit.prevent="store">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700"
                        >Nombre</label
                    >
                    <input
                        type="text"
                        wire:model="name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    />
                    @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700"
                        >Fecha de Inicio</label
                    >
                    <input
                        type="date"
                        wire:model="start_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    />
                    @error('start_date')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700"
                        >Fecha de Fin</label
                    >
                    <input
                        type="date"
                        wire:model="end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    />
                    @error('end_date')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button
                        type="button"
                        wire:click="$set('showModal', false)"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                    >
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                    >
                        {{ $isEditing ? "Actualizar" : "Guardar" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
