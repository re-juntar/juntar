<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\PermissionController;

class PreinscriptionFormBuilder extends Component
{
    public $eventId;

    public $inputs = [];

    protected $listeners = ['sendQuestion' => 'addQuestion', 'refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.preinscription-form-builder', ['eventId' => $this->eventId])->layout(\App\View\Components\AppLayout::class);
    }

    public function mount($eventId){
        $this->eventId = $eventId;
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

    public function saveForm(){
        foreach($this->inputs as $input){
            $question = new Question();
            $question->event_id = $this->eventId;
            $question->type = $input['type'];
            $question->label = $input['label'];
            $question->options = $input['options'];
            $question->save();
        }
        return redirect(route('evento', $this->eventId));
    }
}