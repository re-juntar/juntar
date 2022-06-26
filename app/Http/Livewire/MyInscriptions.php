<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inscription;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyInscriptions extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $userInscriptions = $user->inscriptions();
        $events = [];

        foreach ($userInscriptions as $inscription) {
            $event = $inscription->event()->get();
            array_push($events, $event);
        }

        return view('livewire.my-inscriptions', ['events' => $events]);
    }
}
