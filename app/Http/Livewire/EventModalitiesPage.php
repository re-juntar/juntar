<?php

namespace App\Http\Livewire;

use App\Models\EventModality;
use Livewire\Component;


class EventModalitiesPage extends Component
{
    public $open = false;
    public $description;

    // public $listener = ['render' => 'render'];

    protected $rules = [
        'description' => 'required|string|min:4',
    ];

    // public function mount()
    // {
    //     $this->eventModality = new EventModality();
    // }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, ['description' => 'required|string|min:4']);
    }

    public function save()
    {
        $this->validate();
        EventModality::create([
            'description' => $this->description
        ]);
        $this->reset('open', 'description');
        return redirect()->to('/gestionar/modalidades');
    }

    public function render()
    {
        return view('pages.backend.modalities')->layout('layouts.back');
    }
}
