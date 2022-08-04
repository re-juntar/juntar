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

    protected $listeners = ['showFrontHomeEventModal' => 'openModal', 'inscription', 'preinscription','unsuscribe'];
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
        $this->emit('flyer');
    }

    public function confirmUnsuscribe($event){
        $this->emit('confirmationInscription', [
            'selected' => $event,
            'text' => 'Estas por desinscribirte del Evento ' . $event["name"] . '!',
            'method' => 'unsuscribe',
            'eventid' => $event["id"],
            'component' => 'event-modal',
            'action' => 'Desinscribirme'
        ]);
    }

    public function unsuscribe($eventid){
        $ins = new InscriptionController;
        $evento = $ins->unsubscribe($eventid);      

        $this->emit('ins', [            
            'title' => 'Desinscrito!',
            'text' => 'Te has desinscrito exitosamente del evento!',
            'icon' => 'success'
        ]);
    }

    public function confirmPreRegistration($event){
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
                'text' => 'Estas por pre inscribirte al Evento ' . $event["name"] . '!',
                'method' => 'preinscription',
                'eventid' => $event["id"],
                'component' => 'event-modal',
                'action' => 'Pre incribirme'
            ]);
            
        }
    }

    public function preinscription($eventid){
        return redirect('/evento/'.$eventid.'/formulario-preinscripcion');
    }

    public function confirm($event)
    {

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
                'text' => 'Estas por inscribirte al Evento ' . $event["name"] . '!',
                'method' => 'inscription',
                'eventid' => $event["id"],
                'component' => 'event-modal',
                'action' => 'Incribirme'
            ]);
        }
    }

    public function inscription($eventid)
    {
        $ins = new InscriptionController;
        $evento = $ins->store($eventid);
        $this->emit('ins', $evento);
    }
}
