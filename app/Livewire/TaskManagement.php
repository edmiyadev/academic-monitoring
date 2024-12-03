<?php

namespace App\Livewire;

use App\Enums\StudentEnrollmentStatusEnum;
use App\Enums\TaskStatusEnum;
use App\Models\StudentEnrollment;
use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TaskManagement extends Component
{
    use WithPagination;

    #[Rule('required')]
    public $student_enrollment_id;

    #[Rule('required|max:255')]
    public $title;

    #[Rule('nullable')]
    public $description;

    #[Rule('required|in:1,2,3')]
    public $status = 1;

    #[Rule(rule: 'nullable|date')]
    public $start_date;

    #[Rule('nullable|date|after_or_equal:start_date')]
    public $end_date;

    public $isOpen = false;

    public $editMode = false;

    public $taskId = null;

    public $filterStatus = '';

    public $search = '';

    public function render()
    {
        $query = Task::query()->where('profile_id', auth()->user()->profile->id)
            ->whereRelation('studentEnrollment', 'status', '=', StudentEnrollmentStatusEnum::Progress->value);
        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%');
        }

        $selectedCourses = StudentEnrollment::where('student_id', auth()->user()->profile->id)->where('status', StudentEnrollmentStatusEnum::Progress->value)->get();
        $tasks = $query->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.task-management', [
            'tasks' => $tasks,
            'selectedCourses' => $selectedCourses,
            'statuses' => [
                TaskStatusEnum::Pending->value => 'Pendiente',
                TaskStatusEnum::In_progress->value => 'En Progreso',
                TaskStatusEnum::Completed->value => 'Completada',
            ],
        ]);
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->reset([
            'title',
            'description',
            'status',
            'start_date',
            'end_date',
            'student_enrollment_id',
        ]);
        $this->editMode = false;
        $this->isOpen = true;
    }

    public function createTask()
    {
        $validatedData = $this->validate();
        $validatedData = array_merge($validatedData, [
            'profile_id' => auth()->user()->profile->id,
        ]);

        Task::create($validatedData);

        $this->reset([
            'title',
            'description',
            'status',
            'start_date',
            'end_date',
            'student_enrollment_id',
        ]);

        $this->isOpen = false;
        session()->flash('message', 'Tarea creada exitosamente.');
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);

        $this->taskId = $id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->status = $task->status;
        $this->start_date = $task->start_date;
        $this->end_date = $task->end_date;
        $this->student_enrollment_id = $task->student_enrollment_id;

        $this->editMode = true;
        $this->isOpen = true;
    }

    public function updateTask()
    {
        $validatedData = $this->validate();

        $task = Task::findOrFail($this->taskId);
        $task->update($validatedData);

        $this->reset([
            'taskId',
            'title',
            'description',
            'status',
            'start_date',
            'end_date',
            'student_enrollment_id',
        ]);

        $this->isOpen = false;
        session()->flash('message', 'Tarea actualizada exitosamente.');
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        session()->flash('message', 'Tarea eliminada exitosamente.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }
}
