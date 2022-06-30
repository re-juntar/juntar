<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;

class EndorsementsPage extends Component
{
    public function render()
    {
        return view('pages.backend.endorsements')->layout('layouts.back');
    }
}
