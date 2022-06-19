<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;

class Events extends Component
{
    public $eventos;
    public function render()
    {
        return view('livewire.events', ['eventos' => Event::all()]);
    }
}
