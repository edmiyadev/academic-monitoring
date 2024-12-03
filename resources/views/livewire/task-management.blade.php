<div>
    {{-- Mensaje de éxito --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Gestión de Tareas</h2>
        <button
                wire:click="openModal"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Nueva Tarea
        </button>
    </div>

    <div class="mb-4 flex space-x-4">
        {{-- Búsqueda --}}
        <input
                type="text"
                wire:model.live="search"
                placeholder="Buscar tarea..."
                class="flex-grow border rounded px-3 py-2"
        >

        <select
                wire:model.live="filterStatus"
                class="border rounded px-3 py-2"
        >
            <option value="">Todos los estados</option>
            @foreach($statuses as $key => $status)
                <option value="{{ $key }}">{{ $status }}</option>
            @endforeach
        </select>
    </div>

    <div class="bg-white shadow-md rounded">
        <table class="w-full">
            <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Asignatura</th>
                <th class="py-3 px-6 text-left">Título</th>
                <th class="py-3 px-6 text-left">Estado</th>
                <th class="py-3 px-6 text-left">Fecha Inicio</th>
                <th class="py-3 px-6 text-left">Fecha Fin</th>
                <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            @forelse($tasks as $task)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">
                        {{ \App\Models\Subject::find($task?->studentEnrollment?->subject_id)?->name }}
                    </td>
                    <td class="py-3 px-6 text-left">{{ $task->title }}</td>
                    <td class="py-3 px-6 text-left">
                            <span class="
                                px-2 py-1 rounded
                                @if($task->status == \App\Enums\TaskStatusEnum::Pending->value) bg-yellow-200 text-yellow-800
                                @elseif($task->status == \App\Enums\TaskStatusEnum::In_progress->value) bg-blue-200 text-blue-800
                                @else bg-green-200 text-green-800
                                @endif
                            ">
                                {{ $statuses[$task->status] }}
                            </span>
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d/m/Y') : 'N/A' }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        {{ $task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('d/m/Y') : 'N/A' }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex justify-center space-x-2">
                            <button
                                    wire:click="editTask({{ $task->id }})"
                                    class="text-blue-500 hover:text-blue-700"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                            </button>
                            <button
                                    wire:click="deleteTask({{ $task->id }})"
                                    onclick="confirm('¿Estás seguro de eliminar esta tarea?') || event.stopImmediatePropagation()"
                                    class="text-red-500 hover:text-red-700"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">
                        No se encontraron tareas.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="p-4">
            {{ $tasks->links() }}
        </div>
    </div>

    {{-- Modal  --}}
    @if($isOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form wire:submit.prevent="{{ $editMode ? 'updateTask' : 'createTask' }}">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                {{ $editMode ? 'Editar Tarea' : 'Crear Nueva Tarea' }}
                            </h3>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Asignatura
                                </label>
                                <select
                                        wire:model="student_enrollment_id"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                >
                                    <option value="">Seleccionar Asignatura</option>
                                    @foreach($selectedCourses as $subject)
                                        <option value="{{ $subject->id }}">
                                            {{ $subject->subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_enrollment_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Título --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Título
                                </label>
                                <input
                                        type="text"
                                        wire:model="title"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="Ingrese el título de la tarea"
                                >
                                @error('title')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Descripción --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Descripción
                                </label>
                                <textarea
                                        wire:model="description"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="Descripción de la tarea (opcional)"
                                        rows="3"
                                ></textarea>
                                @error('description')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Estado --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Estado
                                </label>
                                <select
                                        wire:model="status"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                >
                                    <option value="">Seleccionar Estado</option>
                                    @foreach($statuses as $key => $status)
                                        <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Fechas --}}
                            <div class="flex space-x-4 mb-4">
                                {{-- Fecha de Inicio --}}
                                <div class="flex-1">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Fecha de Inicio
                                    </label>
                                    <input
                                            type="date"
                                            wire:model="start_date"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    >
                                    @error('start_date')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Fecha de Fin --}}
                                <div class="flex-1">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Fecha de Fin
                                    </label>
                                    <input
                                            type="date"
                                            wire:model="end_date"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    >
                                    @error('end_date')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Botones del Modal --}}
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button
                                    type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                {{ $editMode ? 'Actualizar' : 'Crear' }}
                            </button>
                            <button
                                    type="button"
                                    wire:click="closeModal"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            >
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
