<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\Presentation;

class EventCardResponsive extends Component
{
    public $open = false;
    public $event;

    public function render()
    {
        $actualEvent = Event::where('id', $this->event->id)->first();
        $presentations = $actualEvent->presentations()->get();
        return view('livewire.event-card-responsive', compact('presentations'));
    }

    public function deletePresentation(Presentation $presentation){
        $presentation->delete();
    }

    public function addPresentation(){
        $presentation = new Presentation();
        $presentation->event_id = $this->event->id;
        $presentation->title = 'Ingrese nombre';
        $presentation->description = '';
        $presentation->date = '2022-01-01';
        $presentation->start_time = '00:00';
        $presentation->end_time = '00:00';
        $presentation->exhibitors = 'Ingrese presentadores';
        $presentation->resources_link = 'Ingrese link';
        $presentation->save();
    }
}
