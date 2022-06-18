<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EventCardDesktop extends Component
{
    public $open = false;
    public $event;
    public function render()
    {
        return view('livewire.event-card-desktop');
    }
}
