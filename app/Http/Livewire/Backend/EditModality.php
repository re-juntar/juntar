<?php

namespace App\Http\Livewire\Backend;

use App\Models\EventModality;
use Livewire\Component;


class EditModality extends Component
{
    public EventModality $eventModality;

    protected $rules = [
        'eventModality.description' => 'required|string|min:4',
    ];

    public function mount($id)
    {
        $this->eventModality = EventModality::find($id);
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
        return view('livewire.backend.edit-modality')->layout('layouts.back');
    }
}
