<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Hero extends Component
{

    public $source = "https://images.unsplash.com/photo-1456428746267-a1756408f782?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80";

    public function render()
    {
        return view('livewire.hero');
    }
}
