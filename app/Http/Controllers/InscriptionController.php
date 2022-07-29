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
    public function store($eventId)
    {   
        $array = [];
        $event = Event::findOrFail($eventId);
        if(is_null(Auth::user())){            
            $array["redirect"] = true;
            $array["title"] = 'No estas logeado!';
            $array["text"] = 'Debes Ingresar para poder inscribirte al evento, deseas logearte?';
            $array["icon"] = 'warning';
        }
        else{
            
            $inscripcion = new Inscription();
            $user = Auth::user();
            $userId = $user->id;            
            // $inscriptos = Inscription::join('events', 'event_id', '=', 'inscriptions.event_id')
            //     ->join('users', 'users.id', '=', 'inscriptions.user_id')
            //     ->where('events.id', $eventId)
            //     ->get(['users.id']); 
               
                $inscriptos =  Inscription::select('inscriptions.event_id', 'inscriptions.user_id')
                    ->where('inscriptions.user_id', '=', $userId)
                    ->where('inscriptions.event_id' , '=', $eventId)
                    ->get();
               // dd($inscriptos);               
            
            if (count($inscriptos) == 0) {                   
                $inscripcion->user_id = $userId;
                $inscripcion->event_id = $event->id;
                $inscripcion->status = 1;
                $inscripcion->pre_inscription_date = date('Y-m-d');
                $inscripcion->inscription_date = date('Y-m-d');
                $inscripcion->accreditation = 1;
                $inscripcion->certification = "cetificado";
                $inscripcion->save();
                $arreglocontacto = ["name" => $user->name . " " . $user->surname, "evento" => $event->short_name, "fecha" => $event->start_date];
                //  "email"=> $user->email,
                //  "asunto"=> "inscripcion a ".$event->short_name,
                // "detalle" => "gracias por usar nuestro sistema"];
                //$nombre =$event->short_name;
                $correo = new InscriptionMail($arreglocontacto);
                // dd($user->email);
                Mail::to($user->email)->send($correo);
                // dd(Mail::to('santiago.avilez@est.fi.uncoma.edu.ar')->send($correo));
                $array["title"] = 'Inscripcion Exitosa!';
                $array["text"] = 'Te inscribiste al evento'. $event->short_name.'!';
                $array["icon"] = 'success';
                $array["redirect"] = false;
                
            } elseif (count($inscriptos) > 0) {
                $array["title"] = 'Error al inscribir!';
                $array["text"] = 'Ya te has inscrito anteriormente al evento '. $event->short_name.'!';
                $array["icon"] = 'error';
                $array["redirect"] = false;
            }
        }
        //dd($array);
        return $array;
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
