<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Presentation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditPresentation extends Component
{
    public $title, $date, $start_time, $end_time, $exhibitors, $resources_link, $description, $eventId, $presentation;

    protected $rules = [
        'title' => 'required|string|min:4|max:200',
        'description' => 'required',
        'date' => 'required',
        'start_time' => 'required|before_or_equal:end_time',
        'end_time' => 'required',
        'resources_link' => 'max:255',
    ];

    public function mount($eventId, $presentationId)
    {
        $this->presentation = Presentation::findOrFail($presentationId);
        list($d, $m, $y) = explode("/", $this->presentation->date);
        $formatedDate = $y . '-' . $m . '-' . $d;
        $this->title = $this->presentation->title;
        $this->description = $this->presentation->description;
        $this->date = $formatedDate;
        $this->start_time = $this->presentation->start_time;
        $this->end_time = $this->presentation->end_time;
        $this->exhibitors = $this->presentation->exhibitors;
        $this->resources_link = $this->presentation->resources_link;
        $this->eventId = $eventId;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'title' => 'required|string|min:4|max:200',
            'description' => 'required',
            'date' => 'required',
            'start_time' => 'required|before_or_equal:end_time',
            'end_time' => 'required',
            'resources_link' => 'max:255',
        ]);
    }

    public function save()
    {
        $validatedData = $this->validate();
        $this->presentation->update($validatedData);
        return redirect('evento/' . $this->eventId);
    }

    public function render()
    {
        $hasPermission = false;
        $event = Event::findOrFail($this->eventId);
        $this->coorganizers = Event::join('organizers', 'organizers.event_id', '=', 'events.id')
            ->join('users', 'users.id', '=', 'organizers.user_id')
            ->where('events.id', $this->eventId)
            ->get(['users.id']);

        if (!is_null(Auth::user())) {
            if (!$hasPermission && count($this->coorganizers) > 0) {
                foreach ($this->coorganizers as $coorganizer) {
                    if ($coorganizer->id == Auth::user()->id) {
                        $hasPermission = true;
                    }
                }
            }
            if (Auth::user()->id == $event->user_id || $hasPermission) {
                return view('livewire.edit-presentation', ['eventId' => $this->eventId])->layout(\App\View\Components\AppLayout::class);
            } else abort(403);
        } else return redirect('login');
    }
}
