<?php

namespace App\Http\Livewire;

use App\Http\Controllers\InscriptionController;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\FrontHome;
use App\Models\Event;
use App\Models\AcademicUnit;
use App\Models\EndorsementRequest;
use App\Models\Inscription;
use App\Helper\Is_Enrolled;

class ShowEvent extends Component
{
    public $event;
    public $organizer;
    public $coorganizer;
    public $openFlyerModal = false;
    use Is_Enrolled;


    protected $listeners = ['inscription','confirm' =>'confirmInscription'];

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
        /*         $this->isEnrolled = Inscription::join('events', 'event_id', '=', 'inscriptions.event_id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            ->where('events.id', $id)
            ->get(['users.id']); */
    }

    public function render()
    {
        // Check for user permissions to update event data
        $hasPermission = false;

        $userId = Auth::user() ? Auth::user()->id : null;
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

        if (($this->event->status_description == "Draft" || $this->event->status_description == "Disabled") && !$hasPermission) {
            abort(403);
        }

        // Endorsements
        $endorsementRequest = EndorsementRequest::where('event_id', $this->event->id)->get('endorsement_requests.*');
        if (count($endorsementRequest) == 0) {
            $endorsementRequest = null;
        } else {
            $endorsementRequest = $endorsementRequest[0];
        }
        $academicUnits = AcademicUnit::all();

        return view(
            'livewire.show-event',
            [
                'event' => $this->event,
                'coorganizers' => $this->coorganizers,
                'organizer' => $this->organizer,
                'hasPermission' => $hasPermission,
                'endorsementRequest' => $endorsementRequest,
                'academicUnits' => $academicUnits
            ]
        )->layout(\App\View\Components\AppLayout::class);
    }

    public function confirmInscription($event)
    {   
        //dd($event);     
        if(is_null(Auth::user())){
            $array= [];
            $array["title"] = 'No estas logeado!';
            $array["text"] = 'Debes Ingresar para poder inscribirte al evento, deseas logearte?';
            $array["icon"] = 'warning';
            $array["redirect"] = true;
            $this->emit('ins', $array);
        }
        else{
            
            $this->emit('confirmationInscription', [
                'selected' => $event,
                'status' => 'Inscripto!',
                'statusText' => 'Te has inscrito exitosamente al evento!',
                'text' => 'Estas por inscribirte al Evento ' . $event["name"] . '!',
                'method' => 'inscription',
                'eventid' => $event["id"],
                'component' => 'show-event',
                'action' => 'Incribirme'
            ]);
            //dd($event);
        }
        //$evento = $this->storeInscription($event["id"]);
        //dd($event["id"]);

    }
    public function inscription($eventid)
    {
        $ins = new InscriptionController;
        $evento = $ins->store($eventid);
        // if ($evento["redirect"]) {
        //     return redirect('login');
        // }

        $this->emit('ins', $evento);
    }    

}
