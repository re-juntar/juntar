<?php

namespace App\Http\Controllers;

use App\Mail\ContactanosMailable;
use App\Mail\inscriptionMail;
use App\Models\Inscription;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class InscriptionController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( $eventId)
    {
        $event = Event::findOrFail($eventId);
        $inscripcion = new Inscription();
        
        
        $inscriptos = Inscription::join('events', 'event_id', '=', 'inscriptions.event_id')
            ->join('users', 'users.id', '=', 'inscriptions.user_id')
            ->where('events.id', $eventId)
            ->get(['users.id']);    
        if(is_null(Auth::user())) {
            return redirect('login');
        }
        elseif (!is_null(Auth::user()) /* and count($inscriptos)==0 */ ) {
            $user = Auth::user();
            $userId = $user->id;         
            
            $inscripcion->user_id = $userId;
            $inscripcion->event_id = $event->id;
            $inscripcion->status = 1;                        
            $inscripcion->pre_inscription_date = date('Y-m-d');            
            $inscripcion->inscription_date = date('Y-m-d');
            $inscripcion->accreditation = 1;
            $inscripcion->certification = "cetificado";
            $inscripcion->save();
            $arreglocontacto = ["name" => $user->name." ".$user->surname, "img" =>$event->image_flyer, "evento" =>$event->short_name, "fecha" => $event->start_date, "lugar" => $event->venue];
          
            $correo = new InscriptionMail($arreglocontacto);
            
            Mail::to($user->email)->send($correo);
            
            return redirect('home')->with('message', 'Inscripto al evento correctamente!');  
        }
        elseif (count($inscriptos)>0) {
            return redirect('home')->with('error', '   Ya estas inscripto en este evento!');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}