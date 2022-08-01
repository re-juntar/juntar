<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use Livewire\Component;

class AddQuestionsAndAnwers extends Component
{
    public $value;

    public function render()
    {
        $answer = Answer::all()->where('inscription_id', $this->value);
        return view('livewire.add-questions-and-anwers', ['answer' => $answer]);
    }
}
