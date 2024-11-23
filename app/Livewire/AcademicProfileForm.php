<?php

namespace App\Livewire;

use App\Models\Career;
use App\Models\Profile;
use Livewire\Component;

class AcademicProfileForm extends Component
{
    public $educationalLevel;

    public $educationalInstitution;

    public $selectedCareer;

    public $availableCareers = [];

    protected $rules = [
        'educationalLevel' => 'required',
        'educationalInstitution' => 'required',
        'selectedCareer' => 'required|exists:careers,id',
    ];

    public function updatedEducationalLevel()
    {
        $this->loadCareers();
    }

    public function updatedEducationalInstitution()
    {
        $this->loadCareers();
    }

    private function loadCareers()
    {
        if ($this->educationalLevel && $this->educationalInstitution) {
            $this->availableCareers = Career::where('educational_level', $this->educationalLevel)
                ->where('educational_institution', $this->educationalInstitution)
                ->get();
            $this->selectedCareer = ''; // Reset selected career
        }
    }

    public function submit()
    {
        Profile::create([
            'user_id' => auth()->id(),
            'career_id' => $this->selectedCareer,
        ]);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.academic-profile-form');
    }
}
