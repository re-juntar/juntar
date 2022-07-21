<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\PermissionController;
use App\Models\Event;
use Livewire\Component;

class BackHome extends Component
{
    public function render()
    {
        $permission = [];
        $permissionController = new PermissionController();
        if ($permissionController->isLogged()) {
            $permission = $permissionController->isAdmin();
            if ($permission['admin']) {
                return view('pages.backend.back-home')->layout('layouts.back');
            } else {
                $events = Event::paginate(25);
                abort(403);
            }
        } else {
            return view('livewire.backend.login-back');
        }
    }
}
