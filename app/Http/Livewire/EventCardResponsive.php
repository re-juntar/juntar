<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserRole;
use Livewire\Component;

class EventCardResponsive extends Component
{
    public $event;
    public $academicUnits;

    public function render()
    {
        $users = User::all();
        return view('livewire.event-card-responsive', ['users' => $users]);
    }

    public function showModal(){
        $this->emit('showFrontHomeEventModal', $this->event);
    }
}
