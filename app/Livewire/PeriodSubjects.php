<?php

namespace App\Livewire;

use App\Models\StudentEnrollment;
use Livewire\Component;

use App\Models\Period;
use App\Models\Subject;

class PeriodSubjects extends Component
{
    public $periodId;
    public $period;
    public $showModal = false;
    public $selectedSubjectId; // Nueva propiedad para el ID de la materia seleccionada

    protected $rules = [
        'selectedSubjectId' => 'required|exists:subjects,id'
    ];

    public function mount(Period $period, $periodId)
    {
        $this->periodId = $periodId;
        $this->period = $period;
    }

    public function render()
    {

        // Obtener materias ya asignadas al período
        $assignedSubjects = Subject::whereIn('id', function ($query) {
            $query->select('subject_id')
                ->from('student_enrollments')
                ->where('period_id', $this->periodId);
        })->get();

        // Obtener todas las materias disponibles (no asignadas al período)
        $availableSubjects = Subject::whereNotIn('id', function ($query) {
            $query->select('subject_id')
                ->from('student_enrollments')
                ->where('period_id', $this->periodId);
        })->get();

        return view('livewire.period-subjects', [
            'assignedSubjects' => $assignedSubjects,
            'availableSubjects' => $availableSubjects
        ]);
    }

    public function createSubject()
    {
        $this->resetInputs();
        $this->showModal = true;
    }

    public function storeSubject()
    {
        $this->validate();
        // Crear la relación en la tabla student_enrollment
        \DB::table('student_enrollments')->insert([
            'period_id' => $this->periodId,
            'subject_id' => $this->selectedSubjectId,
            'student_id' => auth()->user()->profile->id,
        ]);

        // StudentEnrollment::created([
        //     'period_id' => $this->periodId,
        //     'subject_id' => $this->selectedSubjectId,
        //     'student_id' => auth()->user()->profile->id,
        // ]);

        $this->showModal = false;
        $this->resetInputs();
        session()->flash('message', 'Materia agregada correctamente al período.');
    }

    public function deleteSubject($subjectId)
    {
        // Eliminar solo la relación en student_enrollment
        \DB::table('student_enrollments')
            ->where('period_id', $this->periodId)
            ->where('subject_id', $subjectId)
            ->delete();

        session()->flash('message', 'Materia eliminada del período correctamente.');
    }

    private function resetInputs()
    {
        $this->selectedSubjectId = '';
    }

}
