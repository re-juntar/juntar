<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class EventsPage extends Component
{
    public function render()
    {
        return view('pages.backend.events')->layout('layouts.back');
    }
}
