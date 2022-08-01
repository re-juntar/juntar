<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Inscription;
use Livewire\Component;
use App\Models\Question;

class QAndAModal extends Component
{
    public $open = false;
    
    public $idInscription;
    
    protected $listeners = ['showPyRModal'];

    public function render()
    {   
        $inscriptions = Inscription::all();
        $questions = Question::all();
        $answers = Answer::all();
    return view('livewire.q-and-a-modal',['questions' => $questions, 'answers' => $answers, 'inscriptions' => $inscriptions]);
    }

    public function showPyRModal($id)
    {
        $this->open = true;
        $this->idInscription = $id;
    }
}
