<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use Livewire\Component;

class ModalMoreInformationPresentation extends Component
{
    public $open = false;
    public $presentation;

    protected $listeners = ['showMoreInformationModal'];

    public function render()
    {
        return view('livewire.modal-more-information-presentation');
    }

    public function showMoreInformationModal($id)
    {
        $this->presentation = Presentation::findOrFail($id);
        $this->open = true;
    }
}
