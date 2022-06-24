<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class UsersCrud extends Component
{
    public function render()
    {
        return view('pages.backend.users-crud')->layout('layouts.back');
    }
}
