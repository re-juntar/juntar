<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Helper\Is_Enrolled;

class EventModal extends Component
{
    public $open = false;

    protected $listeners = ['showFrontHomeEventModal' => 'openModal'];

    public $event;

    public $presentations;

    public $academicUnits;

    use Is_Enrolled;

    public function render()
    {
        return view('livewire.event-modal');
    }

    public function openModal(Event $event)
    {
        $this->event = $event;
        $this->presentations = $event->presentations()->get();
        $this->open = true;
    }
}
