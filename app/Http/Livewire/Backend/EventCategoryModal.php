<?php

namespace App\Http\Livewire\Backend;

use App\Models\EventCategory;
use Livewire\Component;

class EventCategoryModal extends Component
{
    public $open = false;

    protected $listeners = ['showCategoryModal' => 'openModal'];

    
    public $description;
    public $eventCategory;

    protected $rules = [
        'description' => 'required|string|min:4'];

    public function render()
    {
        return view('livewire.backend.modal-category');
    }

    public function openModal(EventCategory $eventCategory)
    {
        $this->eventCategory = $eventCategory;        

        $this->description = $eventCategory->description;
        
        $this->open = true;
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName,
        ['description' => 'required|string|min:4']);
    }

    public function submit(){
        $validatedData = $this->validate();
        
        $this->eventCategory->update($validatedData);
        
        $this->reset('open', 'description');
        
        return redirect()->to('/gestionar/event-category');
    } 
}
