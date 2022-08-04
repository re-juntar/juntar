<?php

namespace App\Http\Livewire;

use App\Models\AcademicUnit;
use Livewire\Component;

class ChooseEndorsement extends Component
{
    public $open = false;
    public $event;

    protected $listeners = ['openModal'];

    public function render()
    {
        $academicUnits = AcademicUnit::all();
        return view('livewire.choose-endorsement', ['academicUnits' => $academicUnits]);
    }

    public function openModal()
    {
        $this->open = true;
    }
}
