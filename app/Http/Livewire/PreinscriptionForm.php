<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use Livewire\Component;
use App\Models\Question;

class PreinscriptionForm extends Component
{
    public $eventId;

    public $fields = [];

    public $inputs = [];

    public function render()
    {
        return view('livewire.preinscription-form', ['eventId' => $this->eventId])->layout(\App\View\Components\AppLayout::class);
    }

    public function mount($eventId){
        $this->eventId = $eventId;
        foreach (Question::where('event_id', $eventId)->cursor() as $question) {
            $field['QuestionId'] = $question->id;
            $field['type'] = $question->type;
            $field['label'] = $question->label;
            $field['options'] = [];
            if($question->options != ''){
                $optionsArray = explode("/", $question->options);
                foreach($optionsArray as $option){
                    $field['options'][$option] =  $option;
                }
            }
            array_push($this->fields, $field);
        }
    }

    public function store(){
        foreach($this->inputs as $index => $input){
            $answer = new Answer();
            $answer->question_id = $index;
            /* $answer->inscription_id = $this->inscription_id; */
            if(is_array($input)){
                $fullAnswer = '';
                foreach($input as $item){
                    if($item){
                        $fullAnswer .= '/'.$item;
                    }
                }
                $answer->answer = $fullAnswer;
            }else{
                $answer->answer = $input;
            }
            dd($answer);
        }
    }
}