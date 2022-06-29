<?php

namespace App\Http\Livewire\Backend;

use App\Models\EventModality;
use Livewire\Component;

class CreateEventModality extends Component
{

    public EventModality $eventModality;

    protected $rules = [
        
        'description' => 'required|string|min:6',
        // 'users.email' => 'required|string|max:500|unique:users',
    ];

    public function mount()
    {
        $this->eventModality = new EventModality();
    }

    public function save()
    {
         $this->validate();

        // $this->users->password = time();

        $this->eventModality->save();

        return redirect()->to('/gestionar/modalidadEventos');
       
    }

    public function render()
    {
        // return view('livewire.backend.create-event-modality');
        return view('livewire.backend.create-event-modality')->layout('layouts.back');;
    }
}
