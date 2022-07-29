<?php

namespace App\Http\Livewire;

use App\Http\Controllers\InscriptionController;
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

    protected $listeners = ['inscription','confirm' =>'confirmInscription'];

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
