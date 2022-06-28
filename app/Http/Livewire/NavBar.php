<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavBar extends Component
{
    public $permission;
    public function render()
    {
        return view('livewire.nav-bar');
    }
}
