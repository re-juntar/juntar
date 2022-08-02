<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EventInscriptions extends Component
{

    public $eventId;

    
    public function mount($eventId){
        $this->eventId = $eventId;
    }
    
    public function render()
    {   
        $event = Event::findOrFail($this->eventId);
        if(!is_null(Auth::user()) && Auth::user()->id == $event->user_id){
            return view('livewire.event-inscriptions', ['eventId' => $this->eventId])->layout(\App\View\Components\AppLayout::class);
        }else{
            abort(403);
        }
    }
}
