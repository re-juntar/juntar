<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Events extends Component
{
    use WithPagination;
    public function render()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $events = $user->events()->paginate(5);
        $eventOrganizers = [];
        // $events = Event::where('user_id', $userId)->paginate(5);
        $organizers = $user->organizers()->paginate(5);
        foreach ($organizers as $organizer) {
            $uniqueEvent = $organizer->event()->get();
            array_push($eventOrganizers, $uniqueEvent);
        }
        return view('livewire.events', ['events' => $events, 'organizers' => $eventOrganizers]);
    }
}
