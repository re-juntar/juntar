<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use Livewire\Component;

class QAndAModal extends Component
{
    public $open = false;
    
    public $idInscription;
    
    protected $listeners = ['showPyRModal'];

    public function render()
    {   
        $questionsAndAnswers = Answer::join('questions', 'questions.id', '=', 'answers.question_id')
            ->where('answers.inscription_id', $this->idInscription)
            ->get();
        return view('livewire.q-and-a-modal', ['questionsAndAnswers' => $questionsAndAnswers]);
    }

    public function showPyRModal($id)
    {
        $this->open = true;
        $this->idInscription = $id;
    }
}
