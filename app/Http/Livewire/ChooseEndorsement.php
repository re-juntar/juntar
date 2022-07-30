<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChooseEndorsement extends Component
{
    public $open = false;
    public $event;

    protected $listeners = ['openModal'];
    
    public function render()
    {
        return view('livewire.choose-endorsement');
    }
    
    public function openModal(){
        $this->open = true;
    }
}
