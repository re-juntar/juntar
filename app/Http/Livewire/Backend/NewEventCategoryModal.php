<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\EventCategoryController;
use App\Models\EventCategory;
use Livewire\Component;
use Illuminate\Http\Request;

class NewEventCategoryModal extends Component
{
    public $open = false;

    protected $listeners = ['showNewCategoryModal'];
    public $description;

    protected $rules = [
        'description' => 'required'];

    
    public function render()
    {
        return view('livewire.backend.modal-new-category');
    }
    
    public function showNewCategoryModal()
    {
        $this->open = true;
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName,['description' => 'required']);
    }
     
    public function submit(){        
        $validatedData = $this->validate();

        $eventCategory = new EventCategory();
        
        $eventCategory->store($validatedData);
        
        $this->reset('open', 'description');
        
        return redirect()->to('/gestionar/event-category');
    }
}
