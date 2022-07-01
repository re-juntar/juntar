<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class NewEventCategoryModal extends Component
{
    public $open = false;

    protected $listeners = ['showNewCategoryModal'];

    public function render()
    {
        return view('livewire.backend.modal-new-category');
    }

    public function showNewCategoryModal()
    {
        $this->open = true;
    }
}
