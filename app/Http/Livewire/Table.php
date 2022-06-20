<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Table extends Component
{
    public $head;
    public $body;

    public function render()
    {
        return view('livewire.table');
    }
}
