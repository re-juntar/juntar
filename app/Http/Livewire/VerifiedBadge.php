<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VerifiedBadge extends Component
{
    public $endorsementRequest;
    public $academicUnits;

    public function render()
    {
        return view('livewire.verified-badge');
    }
}
