<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class EventcategoriesPage extends Component
{
    public function render()
    {
        return view('pages.backend.event-category')->layout('layouts.back');
    }
}
