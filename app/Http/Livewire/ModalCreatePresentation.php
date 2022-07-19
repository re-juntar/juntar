<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use Livewire\Component;

class ModalCreatePresentation extends Component
{

    public $openCreate = false;
    public $title, $date, $start_time, $end_time, $exhibitors, $resources_link;
    public $description;
    public $eventId;

    protected $rules = [
        'title' => 'required|string|min:4|max:200',
        'description' => 'required',
        'date' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'exhibitors' => 'required',
        'resources_link' => 'required|string|max:255',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'title' => 'required|string|min:4|max:200',
            'description' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'exhibitors' => 'required',
            'resources_link' => 'required|string|max:255',
        ]);
    }

    public function save()
    {
        //dd($this->description);
        //$this->validate();
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

        $this->reset('openCreate', 'title');
    }

    public function render()
    {
        return view('livewire.modal-create-presentation')->layout('layouts.app');
    }
}
