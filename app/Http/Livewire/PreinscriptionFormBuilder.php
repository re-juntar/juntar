<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;

class PreinscriptionFormBuilder extends Component
{


    public $inputs = [];

    protected $listeners = ['sendQuestion' => 'addQuestion', 'refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.preinscription-form-builder')->layout(\App\View\Components\AppLayout::class);
    }

    public function showModal(){
        $this->emit('showModal');
    }

    public function addQuestion($inputs){
        array_push($this->inputs, $inputs);
    }

    public function removeQuestion($key){
        unset($this->inputs[$key]);
        $this->inputs = array_values($this->inputs);
        $this->emit('refreshComponent');
    }
}