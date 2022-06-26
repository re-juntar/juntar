<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class EventsTable extends Component
{
    public function render()
    {
        return view('backend.events-table')->layout('layouts.back');
    }
}
