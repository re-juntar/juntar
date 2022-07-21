<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Http\Livewire\FrontHome;
use App\Models\Event;

class ShowEvent extends Component
{
    public $event;
    public $organizer;
    public $coorganizer;
    public $openFlyerModal = false;

    public function mount($id)
    {
        $this->event = Event::join('event_modalities', 'event_modalities.id', '=', 'events.event_modality_id')
            ->join('event_categories', 'event_categories.id', '=', 'events.event_category_id')
            ->join('event_statuses', 'event_statuses.id', '=', 'events.event_status_id')
            ->where('events.id', $id)
            ->get(['events.*', 'event_modalities.description as modality_description', 'event_categories.description as category_description', 'event_statuses.description as status_description'])[0];
        $this->organizer = $this->event->user;
        $this->coorganizers = Event::join('organizers', 'organizers.event_id', '=', 'events.id')
            ->join('users', 'users.id', '=', 'organizers.user_id')
            ->where('events.id', $id)
            ->get(['users.name', 'users.surname']);
    }

    public function render()
    {
        $hasPermission = false;

        if (!is_null(Auth::user())) {
            $userId = Auth::user()->id;
            if ($userId == $this->event->user_id) {
                $hasPermission = true;
            }

            if (!$hasPermission && count($this->coorganizers) > 0) {
                foreach ($this->coorganizers as $coorganizer) {
                    if ($coorganizer->id == $userId) {
                        $hasPermission = true;
                    }
                }
            }
        }
        if (($this->event->status_description == "Draft" || $this->event->status_description == "Disabled") && !$hasPermission) {
            return redirect()->action(FrontHome::class);
        }

        return view('livewire.show-event', ['event' => $this->event, 'coorganizers' => $this->coorganizers, 'organizer' => $this->organizer, 'hasPermission' => $hasPermission])->layout(\App\View\Components\AppLayout::class);
    }
}
