<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Event;
use Livewire\Component;
use App\Models\Question;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;
use App\Helper\Is_Enrolled;

class PreinscriptionForm extends Component
{
    public $eventId;

    public $fields = [];

    public $inputs = [];

    use Is_Enrolled;

    public function render()
    {
        return view('livewire.preinscription-form', ['eventId' => $this->eventId])->layout(\App\View\Components\AppLayout::class);
    }

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $event = Event::findOrFail($this->eventId);
        $today = strtotime(date('d-m-Y'));
        $inscription_end_date = strtotime($event->inscription_end_date);
        $arrEnrolledUser = $this->is_enrolled($eventId);
        if ($event->pre_registration && $today <= $inscription_end_date && !is_null(Auth::user()) && count($arrEnrolledUser) == 0  && $event->capacity != 0) {
            foreach (Question::where('event_id', $eventId)->cursor() as $question) {
                $field['QuestionId'] = $question->id;
                $field['type'] = $question->type;
                $field['label'] = $question->label;
                $field['options'] = [];
                if ($question->options != '') {
                    $optionsArray = explode("/", $question->options);
                    foreach ($optionsArray as $option) {
                        $field['options'][$option] =  $option;
                    }
                }
                array_push($this->fields, $field);
            }
        } else abort(403);
    }

    public function store()
    {
        $event = Event::findOrFail($this->eventId);
        $today = strtotime(date('d-m-Y'));
        $end_date = strtotime($event->end_date);
        $inscription_end_date = strtotime($event->inscription_end_date);
        $arrEnrolledUser = $this->is_enrolled($this->eventId);
        if (!is_null(Auth::user())) {
            if ($event->pre_registration && $today <= $inscription_end_date && count($arrEnrolledUser) == 0 && $event->capacity != 0) {
                $inscription = new Inscription();
                $inscription->user_id = Auth::user()->id;
                $inscription->event_id = $this->eventId;
                $inscription->status = 1;
                $inscription->pre_inscription_date = date('Y-m-d');
                $inscription->save();
                if ($event->capacity > 0) {
                    $event->decrement('capacity', 1);
                }

                foreach ($this->inputs as $index => $input) {
                    $answer = new Answer();
                    $answer->question_id = $index;
                    $answer->inscription_id = $inscription->id;
                    if (is_array($input)) {
                        $fullAnswer = '';
                        foreach ($input as $item) {
                            if ($item) {
                                $fullAnswer .= '/' . $item;
                            }
                        }
                        $answer->description = $fullAnswer;
                    } else {
                        $answer->description = $input;
                    }
                    $answer->save();
                }
            }
            return redirect(route('evento', $this->eventId));
        } else return redirect(route('login'));
    }
}
