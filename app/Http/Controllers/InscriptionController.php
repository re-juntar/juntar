<?php

namespace App\Http\Controllers;

use App\Exports\EventInscriptionsExport;
use App\Mail\ContactanosMailable;
use App\Mail\inscriptionMail;
use App\Models\Inscription;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

use App\Exports\inscriptionsExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

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

            $inscripcion->user_id = $userId;
            $inscripcion->event_id = $event->id;
            $inscripcion->status = 1;
            $inscripcion->pre_inscription_date = date('Y-m-d');
            $inscripcion->inscription_date = date('Y-m-d');
            $inscripcion->accreditation = 1;
            $inscripcion->certification = "cetificado";
            $inscripcion->save();
            $arreglocontacto = ["name" => $user->name." ".$user->surname, "evento" =>$event->short_name, "fecha" => $event->start_date];
            $correo = new InscriptionMail($arreglocontacto);

            if (!Mail::to($user->email)->send($correo)) abort(500);

            return redirect('home')->with('message', 'Inscripto al evento correctamente!');
        }
        // elseif (count($inscriptos)>0) {
        //     return redirect('home')->with('error', '   Ya estas inscripto en este evento!');
        // }
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

    public function export($eventId) 
    {
      return (new EventInscriptionsExport($eventId))->download("insriptos.xlsx");
// return Excel::download(new EventInscriptionsExport($eventId), 'inscriptos.xlsx');
    }

}
