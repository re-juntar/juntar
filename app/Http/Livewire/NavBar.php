<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavBar extends Component
{
    private $permission;
    public function render()
    {
        return view('livewire.nav-bar');
    }
}
