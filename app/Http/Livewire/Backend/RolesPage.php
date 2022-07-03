<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class RolesPage extends Component
{
    public function render()
    {
        return view('pages.backend.roles')->layout('layouts.back');
    }
}
