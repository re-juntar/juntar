<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;

class Events extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.events', ['events' => Event::paginate(5)]);
    }
}
