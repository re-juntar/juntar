<?php

namespace App\Http\Livewire\Backend;

use App\Models\EventCategory;
use Livewire\Component;

class EventCategoryModal extends Component
{
    public $open = false;

    protected $listeners = ['showCategoryModal' => 'openModal'];

    public $eventCategory;

    public function render()
    {
        return view('livewire.backend.modal-category');
    }

    public function openModal(EventCategory $eventCategory)
    {
        $this->eventCategory = $eventCategory;
        $this->open = true;
    }
}
