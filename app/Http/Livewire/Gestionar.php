<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Gestionar extends Component
{
    public function render()
    {
        return view('backend.gestionar')->layout('layouts.back');
    }
}
