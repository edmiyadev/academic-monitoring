<?php

namespace App\Livewire;

use App\Models\Period;
use App\Models\Subject;
use Livewire\Component;

class PeriodManagement extends Component
{
    // app/Http/Livewire/PeriodManagement.php
    public $showModal = false;
    public $isEditing = false;
    public $periodId;
    public $name;
    public $start_date;
    public $end_date;

    protected $rules = [
        'name' => 'required|min:3',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date'
    ];

    public function render()
    {
        return view('livewire.period-management', [
            'periods' => Period::latest()->get()
        ]);
    }

    public function create()
    {
        $this->reset(['name', 'start_date', 'end_date', 'periodId']);
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        if ($this->isEditing) {
            $period = Period::find($this->periodId);
            $period->update([
                'name' => $this->name,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);
        } else {
            Period::create([
                'name' => $this->name,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);
        }

        $this->showModal = false;
        $this->reset(['name', 'start_date', 'end_date', 'periodId']);
    }

    public function edit($periodId)
    {
        $this->isEditing = true;
        $this->periodId = $periodId;
        $period = Period::find($periodId);
        $this->name = $period->name;
        $this->start_date = $period->start_date;
        $this->end_date = $period->end_date;
        $this->showModal = true;
    }

    public function delete($periodId)
    {
        Period::find($periodId)->delete();
    }

    public function addSubject($periodId)
    {
        return redirect()->route('period.subjects', $periodId);
    }
}


