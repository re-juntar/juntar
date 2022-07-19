<?php

namespace App\Http\Livewire;

use App\Models\Presentation;
use Livewire\Component;

class ModalEditPresentation extends Component
{
    public $openEdit = false;
    public $title, $description, $date, $start_time, $end_time, $exhibitors, $resources_link;
    public $eventId;
    protected $listeners = ['showPresentationModalEdit' => 'openModalEdit'];
    public $presentation;

    protected $rules = [
        'title' => 'required|string|min:4|max:200',
        'description' => 'required|string|min:4',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'exhibitors' => 'required',
        'resources_link' => 'required|string|max:255',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'title' => 'required|string|min:4|max:200',
            'description' => 'required|string|min:4',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'exhibitors' => 'required',
            'resources_link' => 'required|string|max:255',
        ]);
    }

    public function save()
    {/* 
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
        $this->reset('openEdit', 'title'); */
        $validatedData = $this->validate();

        // Execution doesn't reach here if validation fails.

        $this->presentation->update($validatedData);
        return redirect()->to('/evento/' . $this->eventId . '#presentations');
    }


    public function openModalEdit(Presentation $presentation)
    {
        list($d, $m, $y) = explode("/", $presentation->date);
        $formatedDate = $y . '-' . $m . '-' . $d;
        $this->presentation = $presentation;
        $this->title = $presentation->title;
        $this->description = $presentation->description;
        $this->date = $formatedDate;
        $this->start_time = $presentation->start_time;
        $this->end_time = $presentation->end_time;
        $this->exhibitors = $presentation->exhibitors;
        $this->resources_link = $presentation->resources_link;
        $this->openEdit = true;
    }

    public function render()
    {
        return view('livewire.modal-edit-presentation')->layout('layouts.app');
    }
}
