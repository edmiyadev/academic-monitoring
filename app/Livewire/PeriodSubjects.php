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

    public $subjectStatuses = [];

    protected $rules = [
        'selectedSubjectId' => 'required|exists:subjects,id',
        //        'subjectStatuses.*' => 'in:' . StudentEnrollmentStatusEnum::getValues(),
    ];

    public function mount(Period $period, $periodId)
    {
        $this->periodId = $periodId;
        $this->period = Period::find($periodId);

        // Initialize subject statuses from existing enrollments
        $enrollments = StudentEnrollment::where('period_id', $this->periodId)->get();
        $this->subjectStatuses = $enrollments->pluck('status', 'subject_id')->toArray();
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

        $statusOptions = StudentEnrollmentStatusEnum::cases();

        return view('livewire.period-subjects', [
            'assignedSubjects' => $assignedSubjects,
            'availableSubjects' => $availableSubjects,
            'statusOptions' => $statusOptions,
        ]);
    }

    public function updateSubjectStatus($subjectId, $status)
    {
        // Find the existing enrollment
        $enrollment = StudentEnrollment::where('period_id', $this->periodId)
            ->where('subject_id', $subjectId)
            ->first();

        if ($enrollment) {
            // Update the status
            $enrollment->update([
                'status' => $status,
            ]);

            // Update local status array
            $this->subjectStatuses[$subjectId] = $status;

            session()->flash('message', 'Estado de la materia actualizado correctamente.');
        }
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

        $enrollment = StudentEnrollment::create([
            'period_id' => $this->periodId,
            'subject_id' => $this->selectedSubjectId,
            'student_id' => auth()->user()->profile->id,
            'status' => StudentEnrollmentStatusEnum::Progress->value,
        ]);

        // Add the new subject to the local statuses array
        $this->subjectStatuses[$this->selectedSubjectId] = $enrollment->status;

        $this->showModal = false;
        $this->resetInputs();
        session()->flash('message', 'Materia agregada correctamente al período.');
    }

    public function deleteSubject($subjectId)
    {
        StudentEnrollment::where('period_id', $this->periodId)
            ->where('subject_id', $subjectId)
            ->delete();

        // Remove the subject from local statuses
        unset($this->subjectStatuses[$subjectId]);

        session()->flash('message', 'Materia eliminada del período correctamente.');
    }

    private function resetInputs()
    {
        $this->selectedSubjectId = '';
    }
}
