<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscription;
use App\Models\Event;

class MyInscriptions extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.my-inscriptions', ['events' => Event::paginate(5)]);
    }
}
