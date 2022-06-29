<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\Presentation;

class EventModal extends Component
{
    public $open = false;

    protected $listeners = ['showModal' => 'openModal'];

    public $event;

    public $presentations;

    public function render()
    {
        return view('livewire.event-modal');
    }

    public function openModal(Event $event){
        $this->event = $event;
        $this->presentations = $event->presentations()->get();
        $this->open = true;
    }
}
