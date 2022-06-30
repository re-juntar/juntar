<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\EventModality;

class CreateModality extends Component
{
    public EventModality $eventModality;

    protected $rules = [
        'eventModality.description' => 'required|string|min:4',
    ];

    public function mount()
    {
        $this->eventModality = new EventModality();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, ['eventModality.description' => 'required|string|min:4']);
    }

    public function save()
    {
        $this->validate();
        $this->eventModality->save();
        return redirect()->to('/gestionar/modalidades');
    }

    public function render()
    {
        return view('livewire.backend.create-modality')->layout('layouts.back');
    }
}
