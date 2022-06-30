<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CustomInput extends Component
{

    public $type;

    public $label;

    public $options;


    public function render()
    {
        return view('livewire.custom-input');
    }
}
