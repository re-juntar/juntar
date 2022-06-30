<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class PreinscriptionForm extends Component
{
    public $eventId;

    public $inputs = [];

    public function render()
    {
        return view('livewire.preinscription-form', ['eventId' => $this->eventId])->layout(\App\View\Components\AppLayout::class);
    }

    public function mount($eventId){
        $this->eventId = $eventId;
        foreach (Question::where('event_id', $eventId)->cursor() as $question) {
            $inputs['type'] = $question->type;
            $inputs['label'] = $question->label;
            $inputs['options'] = $question->options;
            array_push($this->inputs, $inputs);
        }
    }
}
