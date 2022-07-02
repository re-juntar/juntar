<?php

namespace App\Http\Livewire\Backend;

use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RoleModal extends Component
{
  public $open = false;

  protected $listeners = ['showRoleModalEdit' => 'openModalEdit']; 
   
  public $name;
  public $description; 
  public $role;

  protected $rules = [
    'name' => 'required|string|min:2',
    'description' => 'required|string|min:2',
  ];

  // protected $messages = [
  //   'name.required' => 'Ingrese una nombre.',
  //   'description.required' => 'Ingrese una descripcion.',
  // ];


  public function render()
  {
    return view('livewire.backend.modal-role-edit');
  }

  public function updated($fields){
        $this->validateOnly($fields, [
          'name' => 'required|string|min:2',
          'description' => 'required|string|min:2',
        ]);
  }

  public function submit()
  {
    
    $validatedData = $this->validate();

    // Execution doesn't reach here if validation fails.
    
      $this->role->updateRole($validatedData);
      return redirect()->to('/gestionar/roles');
    
  }



  public function openModalEdit(Role $role)
  {
    $this->role = $role;
    $this->name = $role->name;
    $this->description = $role->description;
    $this->open = true;
  }
}
