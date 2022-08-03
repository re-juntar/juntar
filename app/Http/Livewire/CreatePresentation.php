<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Presentation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePresentation extends Component
{
    public $title, $date, $start_time, $end_time, $exhibitors, $resources_link, $description, $eventId, $event;

    protected $rules = [
        'title' => 'required|string|min:4|max:200',
        'description' => 'required',
        'date' => 'required',
        'start_time' => 'required|before_or_equal:end_time',
        'end_time' => 'required',
        'resources_link' => 'max:255',
    ];

    public function mount($eventId)
    {
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
            'resources_link' => 'string|max:255',
        ]);
    }

    public function save()
    {
        $this->validate();
        Presentation::create([
            'event_id' => $this->eventId,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'exhibitors' => $this->exhibitors,
            'resources_link' => $this->resources_link,
        ]);

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
                return view('livewire.create-presentation', ['eventId' => $this->eventId])->layout(\App\View\Components\AppLayout::class);
            } else abort(403);
        } else return redirect('login');
    }
}
