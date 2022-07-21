<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\Presentation;

class EventCardResponsive extends Component
{
    public $event;
    public $academicUnits;

    public function render()
    {
        return view('livewire.event-card-responsive');
    }

    public function showModal(){
        $this->emit('showModal', $this->event);
    }
}
