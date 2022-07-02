<?php

namespace App\Http\Livewire\Backend;

use App\Models\EventModality;
use Livewire\Component;


class EditModality extends Component
{
    public EventModality $eventModality;
    public $open = true;
    public $description;

    protected $rules = [
        'description' => 'required|string|min:4',
    ];

    public function mount($id)
    {
        $this->eventModality = EventModality::find($id);
        $this->description = $this->eventModality->description;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, ['description' => 'required|string|min:4']);
    }


    public function save()
    {
        $this->validate();
        $this->eventModality->update([
            'description' => $this->description
        ]);
        $this->reset('open', 'description');
        return redirect()->to('/gestionar/modalidades');
    
        // $this->validate();
        // $this->evnetModality->description = $this->description;
        // $this->eventModality->save();
        // return redirect()->to('/gestionar/modalidades');
    }

    public function render()
    {
        return view('livewire.backend.edit-modality')->layout('layouts.back');
    }
}
