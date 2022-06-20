<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventCardDesktop extends Component
{
    public $open = false;
    public $event;
    public function render()
    {
        $presentationsAndExhibitors = [];
        $exhibitors = [];
        $i = 0;
        $actualEvent = Event::where('id', $this->event->id)->first();
        $presentations = $actualEvent->presentations()->get();
        foreach ($presentations as $presentation) {
            $presentationExhibitors = $presentation->exhibitors()->get();

            foreach ($presentationExhibitors as $presentationExhibitor) {
                $exhibitor = $presentationExhibitor->user()->get();
                array_push($exhibitors, $exhibitor);
            }

            $presentationsAndExhibitors[$i]['exhibitors'] = $exhibitors;
            $presentationsAndExhibitors[$i]['presentation'] = $presentation;
            $i++;
        }
        return view('livewire.event-card-desktop', compact('presentationsAndExhibitors'));
    }
}
