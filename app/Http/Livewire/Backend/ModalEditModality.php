<?php

namespace App\Http\Livewire\Backend;

use App\Models\EventModality;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ModalEditModality extends Component
{
    protected $model = EventModality::class;

    public $openEdit = false;
    public $description;

    protected $listeners = ['showModalityModalEdit' => 'openModalEdit'];

    protected $rules = [
        'description' => 'required|string|min:4',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'description' => 'required|string|min:4',
        ]);
    }

    public function save()
    {
        $validatedData = $this->validate();
        $this->modality->update($validatedData);
        return redirect()->to('/gestionar/modalidades');
    }

    public function openModalEdit(EventModality $modality)
    {
        $this->modality = $modality;
        $this->description = $modality->description;
        $this->openEdit = true;
    }

    public function render()
    {
        return view('livewire.backend.modal-edit-modality')->layout('layouts.back');
    }
}
