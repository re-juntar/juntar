<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class UsersPage extends Component
{
    public function render()
    {
        return view('pages.backend.users')->layout('layouts.back');
    }
}
