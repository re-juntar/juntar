<?php

namespace App\Http\Livewire\Backend;

use App\Models\EventModality;
use Livewire\Component;

class ModalCreateModality extends Component
{
    protected $model = EventModality::class;

    public $openCreate = false;
    public $description;

    protected $listeners = ['showModalityModalCreate' => 'openModalCreate'];

    protected $rules = [
        'description' => 'required|string|min:4',
    ];


    public function openModalCreate()
    {
        $this->openCreate = true;
    }

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
        $this->reset('openCreate', 'description');
        return redirect()->to('/gestionar/modalidades');
    }

    public function render()
    {
        return view('livewire.backend.modal-create-modality')->layout('layouts.back');
    }
}
