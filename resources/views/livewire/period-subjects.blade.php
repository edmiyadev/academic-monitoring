<div class="p-6">
    <div class="flex justify-between items-center mb-6">

        <button
        wire:click="backPage"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
        >
        Atras
    </button>

    <h2 class="text-2xl font-semibold text-gray-900">
        Materias del Período: {{ $period->name }}
    </h2>

        <button
            wire:click="createSubject"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
        >
            Agregar Materia
        </button>
    </div>

    @if (session()->has('message'))
    <div
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
    >
        {{ session("message") }}
    </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Código
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Nombre
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        HT
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        HP
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        CR
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($assignedSubjects as $subject)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $subject->code }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $subject->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $subject->theoretical_hours }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $subject->practical_hours }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $subject->credits }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button
                            wire:click="deleteSubject({{ $subject->id }})"
                            class="text-red-600 hover:text-red-900"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
                @endforeach @if($assignedSubjects->isEmpty())
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        No hay materias asignadas a este período
                    </td>
                </tr>
                @endif
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
                Agregar Materia al Período
            </h3>

            <form wire:submit.prevent="storeSubject">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700"
                        >Seleccionar Materia</label
                    >
                    <select
                        wire:model="selectedSubjectId"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                    >
                        <option value="">Seleccione una materia...</option>
                        @foreach($availableSubjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->code }} - {{ $subject->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('selectedSubjectId')
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
                        @if(!$availableSubjects->count())
                            disabled
                        @endif
                    >
                        Agregar al Período
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
