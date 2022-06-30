<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\PermissionController;
use App\Models\Event;
use Livewire\Component;

class EndorsementsPage extends Component
{
    public function render()
    {
        $permission = [];
        $permissionController = new PermissionController();
        if ($permissionController->isLogged()) {
            $permission = $permissionController->isAdmin();
            if ($permission['admin']) {
                return view('pages.backend.endorsements')->layout('layouts.back');
                // return $this->render();
            } else {
                $events = Event::paginate(25);
                return view('pages.front-home', ['events' => $events])->layout(\App\View\Components\AppLayout::class);
            }
        } else {
            return view('livewire.backend.login-back');
        }
    }
}
