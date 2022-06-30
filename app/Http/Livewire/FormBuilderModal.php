<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormBuilderModal extends Component
{
    protected $listeners = ['showModal' => 'openModal'];

    public $open = false;
    
    public $type;

    public $label;

    public $options;

    public function render()
    {
        return view('livewire.form-builder-modal');
    }

    public function openModal(){
        $this->open = true;
    }

    public function submit(){
        $inputs = ['type' => $this->type, 'label' => $this->label, 'options' => $this->options];
        $this->emitUp('sendQuestion', $inputs);
        $this->reset();
    }

}