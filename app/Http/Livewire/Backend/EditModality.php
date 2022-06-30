<?php

namespace App\Http\Livewire\Backend;

use App\Models\EventModality;
use Livewire\Component;


class EditModality extends Component
{
    public EventModality $eventModality;

    protected $rules = [
        'eventModality.description' => 'required|string|min:6',
    ];

    // ventModality::where('id', $this->getSelected())->update(['description' => $this->getSelected()[0]])
   

    public function mount($id)
    {
        // $this->eventModality = new EventModality();
        $this->eventModality = EventModality::find($id);
    }

    public function save()
    {
        // $this->validate();

        // $this->users->password = time();

        $this->eventModality->save();

        return redirect()->to('/gestionar/modalidades');
    }
   
    public function render()
    {
        return view('livewire.backend.edit-modality')->layout('layouts.back');
    }
}
