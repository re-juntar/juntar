<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class LimpiarInput extends Component
{
    public $photo;
    public $iteration;
    public $predeterminada;
    public $img;
    public $tipo;
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
