<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use Livewire\Component;
use App\Models\Question;

class QAndAModal extends Component
{
    public $open = true;

    protected $listeners = ['showPyRModal'];

    public function render()
    {   
        $questions = Question::all();
        $answers = Answer::all();
        return view('livewire.q-and-a-modal',['questions' => $questions, 'answers' => $answers]);
    }

    public function showPyRModal()
    {
        $this->open = true;
    }
}
