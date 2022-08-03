<?php

namespace App\Http\Livewire;

use App\Http\Controllers\InscriptionController;
use App\Models\Event;
use Livewire\Component;
use App\Helper\Is_Enrolled;
use Illuminate\Support\Facades\Auth;

class EventModal extends Component
{
    public $open = false;

    protected $listeners = ['showFrontHomeEventModal' => 'openModal', 'inscription'];
    public $openFlyerModal = false;
    public $event;

    public $presentations;

    public $academicUnits;

    use Is_Enrolled;

    public function render()
    {
        return view('livewire.event-modal');
    }

    public function openModal(Event $event)
    {
        $this->event = $event;
        $this->presentations = $event->presentations()->get();
        $this->open = true;
    }
    public function openFlyerModal($event)
    {   
        //dd($event);
        //$this->open = false;
        
        // dd($event);        
        $this->emit('flyer');
    }

    public function confirm($event)
    {
        //dd($event);
        
        if (is_null(Auth::user())) {
            $array = [];
            $array["title"] = 'No estas logeado!';
            $array["text"] = 'Debes Ingresar para poder inscribirte al evento, deseas logearte?';
            $array["icon"] = 'warning';
            $array["redirect"] = true;
            $this->emit('ins', $array);
        } else {

            $this->emit('confirmationInscription', [
                'selected' => $event,
                'status' => 'Inscripto!',
                'statusText' => 'Te has inscrito exitosamente al evento!',
                'text' => 'Estas por inscribirte al Evento ' . $event["name"] . '!',
                'method' => 'inscription',
                'eventid' => $event["id"],
                'component' => 'event-modal',
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
