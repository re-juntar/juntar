<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class UsersTable extends Component
{
    public function render()
    {
        return view('pages.backend.users-table')->layout('layouts.back');
    }
}
