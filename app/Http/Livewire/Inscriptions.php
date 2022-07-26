<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Inscriptions extends Component
{

    public $eventId;

    
    public function mount($eventId){
        $this->eventId = $eventId;
    }
    
    public function render()
    {
        return view('livewire.inscriptions', ['eventId' => $this->eventId])->layout(\App\View\Components\AppLayout::class);
    }
}
