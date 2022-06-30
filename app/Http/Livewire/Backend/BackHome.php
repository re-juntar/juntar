<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class BackHome extends Component
{
    public function render()
    {
        return view('pages.backend.back-home')->layout('layouts.back');
    }
}
