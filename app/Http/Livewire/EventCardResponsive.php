<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EventCardResponsive extends Component
{
    public $event;

    public function render()
    {
        return view('livewire.event-card-responsive');
    }

    public function showModal(){
        $this->emit('showFrontHomeEventModal', $this->event);
    }
}
