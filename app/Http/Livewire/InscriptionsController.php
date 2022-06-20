<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscription;
use App\Models\Event;

class InscriptionsController extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.my-event-inscription',['eventos' => Event::paginate(5)]);
    }
    
}