<?php

namespace App\Http\Livewire\Backend;

use App\Models\Role;
use Livewire\Component;

class RoleModalCreate extends Component
{
  public $opencreate = false;

  protected $listeners = ['showRoleModalcreate' => 'openModalCreate' ];

  public $rolecreate;

  public $messagecreate = 'mensaje error asfja';

  public function render()
  {           
    return view('livewire.backend.modal-role-create');
  }

  public function openModalCreate()  {
      
      $this->opencreate = true;
  }
}