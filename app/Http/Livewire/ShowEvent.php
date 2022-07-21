<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Http\Livewire\FrontHome;
use App\Models\Event;
use App\Models\AcademicUnits;
use App\Models\EndorsementRequest;

class ShowEvent extends Component
{
    public $event;
    public $organizer;
    public $coorganizer;
    public $openFlyerModal = false;

    public function mount($id)
    {
        $event = Event::join('event_modalities', 'event_modalities.id', '=', 'events.event_modality_id')
            ->join('event_categories', 'event_categories.id', '=', 'events.event_category_id')
            ->join('event_statuses', 'event_statuses.id', '=', 'events.event_status_id')
            ->where('events.id', $id)
            ->get(['events.*', 'event_modalities.description as modality_description', 'event_categories.description as category_description', 'event_statuses.description as status_description']);

        if (count($event) === 0) abort(404);

        $this->event = $event[0];
        $this->organizer = $this->event->user;
        $this->coorganizers = Event::join('organizers', 'organizers.event_id', '=', 'events.id')
            ->join('users', 'users.id', '=', 'organizers.user_id')
            ->where('events.id', $id)
            ->get(['users.name', 'users.surname']);
    }

    public function render()
    {

        // Check for user permissions to update event data
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

        // Endorsements
        $endorsementRequest = EndorsementRequest::where('event_id', $this->event->id)->get('endorsement_requests.*');
        if(count($endorsementRequest) == 0){
            $endorsementRequest = null;
        }else{
            $endorsementRequest = $endorsementRequest[0];
        }
        $academicUnits = AcademicUnits::all();

        return view('livewire.show-event',
        [
            'event' => $this->event,
            'coorganizers' => $this->coorganizers,
            'organizer' => $this->organizer,
            'hasPermission' => $hasPermission,
            'endorsementRequest' => $endorsementRequest,
            'academicUnits' => $academicUnits
        ])->layout(\App\View\Components\AppLayout::class);
    }
}
