<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class LimpiarInput extends Component
{
    public $photo;
    public $event;
    public $iteration;
    public $predeterminada;
    use WithFileUploads;

    public function limpiar()
    {
        $this->photo=null;
        $this->iteration++;
        $this->predeterminada = null;
    }

    public function render()
    {
        return view('livewire.limpiar-input');
    }
}
