<?php

namespace App\Http\Livewire\Backend;

use App\Models\Role;
use Livewire\Component;

class RoleModalCreate extends Component
{
  public $opencreate = false;

  protected $listeners = ['showRoleModalcreate' => 'openModalCreate' ];

  
  public $name;
  public $description; 

  protected $rules = [
    'name' => 'required',
    'description' => 'required',
  ];

  // protected $messages = [
  //   'name.required' => 'Ingrese una nombre.',
  //   'description.required' => 'Ingrese una descripcion.',
  // ];

  public function render()
  {           
    return view('livewire.backend.modal-role-create');
  }

  public function openModalCreate()  {
      
      $this->opencreate = true;
  }

  public function updated($propertyName)
  {
      $this->validateOnly($propertyName);
  }

  public function submit()
  {
      $validateData = $this->validate();
      $rolecreate= new Role();
      $rolecreate->createRole($validateData);
      $this->reset('opencreate', 'description','name');
      return redirect()->to('/gestionar/roles');
  }
}