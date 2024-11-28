<?php

namespace App\Livewire;

use App\Enums\StudentEnrollmentStatusEnum;
use App\Models\Period;
use App\Models\StudentEnrollment;
use App\Models\Subject;
use Livewire\Component;

class PeriodSubjects extends Component
{
    public $periodId;
    public $period;
    public $showModal = false;
    public $selectedSubjectId;

    protected $rules = [
        'selectedSubjectId' => 'required|exists:subjects,id',
    ];

    public function mount(Period $period, $periodId)
    {
        $this->periodId = $periodId;
        $this->period = Period::find($periodId);
    }

    public function render()
    {
        $assignedSubjects = Subject::whereIn('id', function ($query) {
            $query->select('subject_id')
                ->from('student_enrollments')
                ->where('period_id', $this->periodId);
        })->get();

        $availableSubjects = Subject::whereNotIn('id', function ($query) {
            $query->select('subject_id')
                ->from('student_enrollments')
                ->where('status', StudentEnrollmentStatusEnum::Progress->value)
                ->orWhere('status', StudentEnrollmentStatusEnum::Approved->value);
        })->get();

        return view('livewire.period-subjects', [
            'assignedSubjects' => $assignedSubjects,
            'availableSubjects' => $availableSubjects,
        ]);
    }

    public function backPage()
    {
        return redirect()->to('/periods');
    }

    public function createSubject()
    {
        $this->resetInputs();
        $this->showModal = true;
    }

    public function storeSubject()
    {
        $this->validate();

        StudentEnrollment::create([
            'period_id' => $this->periodId,
            'subject_id' => $this->selectedSubjectId,
            'student_id' => auth()->user()->profile->id,
            'status' => StudentEnrollmentStatusEnum::Progress->value,
        ]);

        $this->showModal = false;
        $this->resetInputs();
        session()->flash('message', 'Materia agregada correctamente al período.');
    }

    public function deleteSubject($subjectId)
    {
        StudentEnrollment::where('period_id', $this->periodId)
            ->where('subject_id', $subjectId)
            ->delete();

        session()->flash('message', 'Materia eliminada del período correctamente.');
    }

    private function resetInputs()
    {
        $this->selectedSubjectId = '';
    }
}
