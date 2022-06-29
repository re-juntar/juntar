<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormBuilderModal extends Component
{
    protected $listeners = ['showModal' => 'openModal'];

    public $open = false;
    
    public $type;

    public $label;

    public $options = null;

    protected $rules = [
        'type' => 'required',
        'label' => 'required'
    ];

    public function render()
    {
        return view('livewire.form-builder-modal');
    }

    public function openModal(){
        $this->open = true;
    }

    public function submit(){
        $this->validate();
        $this->open = false;
        // ENVIAR OPTIONS YA FORMATEADO 'VALOR' => 'VALOR'
        $inputs = [$this->type, $this->label, $this->options];
        $this->emitUp('sendQuestion', $inputs);
    }

}