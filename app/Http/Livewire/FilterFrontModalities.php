<?php

namespace App\Http\Livewire;

use App\Models\EventCategory;
use App\Models\EventModality;
use Livewire\Component;

class FilterFrontModalities extends Component
{
    
    public function render()
    {   
        $modalities = EventModality::all();

        return view('livewire.filter-front-modalities',['modalities' => $modalities]);
    }

   
}
