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
use App\Helper\Is_Enrolled;
use App\Models\Answer;

use function PHPUnit\Framework\isNull;

class InscriptionController extends Controller
{
    use Is_Enrolled;
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
        $event = Event::findOrFail($eventId);
        $inscripcion = new Inscription();
        $today = strtotime(date('d-m-Y'));
        $end_date = strtotime($event->end_date);
        if (is_null(Auth::user())) {
            return redirect('login');
        } else {
            if ($event->capacity != 0 && $today <= $end_date && $event->event_status_id == 1 && $event->pre_registration == 0) {
                $arrEnrolledUser = $this->is_enrolled($eventId);
                if (count($arrEnrolledUser) == 0) {
                    $user = Auth::user();
                    $userId = $user->id;

                    $inscripcion->user_id = $userId;
                    $inscripcion->event_id = $event->id;
                    $inscripcion->status = 1;
                    // $inscripcion->pre_inscription_date = date('Y-m-d');
                    // $inscripcion->accreditation = 1;
                    // $inscripcion->certification = "certificado";
                    $inscripcion->inscription_date = date('Y-m-d');
                    $inscripcion->save();
                    $arreglocontacto = ["name" => $user->name . " " . $user->surname, "evento" => $event->short_name, "fecha" => $event->start_date];
                    if ($event->capacity > 0) {
                        $event->decrement('capacity', 1);
                    }
                    /*                      $correo = new InscriptionMail($arreglocontacto); */

                    /* if (!Mail::to($user->email)->send($correo)) abort(500); */
                    return redirect('home')->with('message', 'Inscripto al evento correctamente!');
                } elseif (count($arrEnrolledUser) > 0) {
                    return redirect('home')->with('error', '   Ya estas inscripto en este evento!');
                } else abort(403);
            } else abort(403);
        }
    }

    public function unsubscribe($eventId)
    {
        $event = Event::findOrFail($eventId);
        if (!is_null(Auth::user())) {
            $arrEnrolledUser = $this->is_enrolled($eventId);
            if (isset($arrEnrolledUser[0])) {
                $inscriptionId = $arrEnrolledUser[0]["id"];
                $inscription = Inscription::findOrFail($inscriptionId);
                $answers = Answer::join('inscriptions', 'inscription_id', '=', 'answers.inscription_id')
                    ->where('answers.inscription_id', '=', $inscriptionId)
                    ->distinct()
                    ->get('answers.id');
                $allDeleted = 0;
                if (count($answers) > 0) {
                    $i = 0;
                    while ($i < count($answers)) {
                        if (Answer::findOrFail($answers[$i]['id'])->delete()) {
                            $allDeleted++;
                        }
                        $i++;
                    }
                }
                if ($allDeleted == count($answers)) {
                    if ($inscription->delete() && $event->capacity >= 0) {
                        $event->increment('capacity', 1);
                        return redirect('home')->with('message', 'Desinscripto del evento correctamente!');
                    } else {
                        return redirect('home')->with('error', 'No se pudo desinscribir!');
                    }
                } else abort(403);
            } else abort(403);
        } else {
            return redirect('login');
        }
    }


    // {   
    // $array = [];
    // if(is_null(Auth::user())){            
    // $array["redirect"] = true;
    // $array["title"] = 'No estas logeado!';
    // $array["text"] = 'Debes Ingresar para poder inscribirte al evento, deseas logearte?';
    // $array["icon"] = 'warning';
    // }



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
