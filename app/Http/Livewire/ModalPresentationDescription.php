<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModalPresentationDescription extends Component
{
    public $openDescription;
    public $row;

    public function render()
    {
        return view('livewire.modal-presentation-description');
    }
}
