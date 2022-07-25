<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\PermissionController;
use Livewire\Component;

class SideNav extends Component
{
    public function render()
    {
        return view('livewire.backend.side-nav', ['isAdmin' => PermissionController::isAdmin()]);
    }
}
