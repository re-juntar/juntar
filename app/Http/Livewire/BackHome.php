<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BackHome extends Component
{
    public function render()
    {
        return view('livewire.back-home')->layout('layouts.back');
    }
}
