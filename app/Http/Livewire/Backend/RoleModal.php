<?php

namespace App\Http\Livewire\Backend;

use App\Models\Role;
use Livewire\Component;

class RoleModal extends Component
{
    public $open = false;

    protected $listeners = ['showRoleModalEdit' => 'openModalEdit' ];

    public $role;

    public $message = 'mensaje error asfja';

    public function render()
    {           
      return view('livewire.backend.modal-role-edit');
    }

    public function openModalEdit(Role $role)
    {
        $this->role = $role;
        $this->open = true;
    }
}