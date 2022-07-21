<?php

namespace App\Http\Livewire\Backend;

use App\Http\Controllers\PermissionController;
use App\Models\Event;
use Livewire\Component;

class EventsPage extends Component
{
    public function render()
    {
        $permission = [];
        $permissionController = new PermissionController();
        $permission = $permissionController->isAdmin();

        if (!$permission['admin']) {
            $events = Event::paginate(25);
            return view('pages.front-home', ['events' => $events])->layout(\App\View\Components\AppLayout::class);
        }

        return view('pages.backend.events')->layout('layouts.back');
    }
}
