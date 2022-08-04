<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use SplSubject;

class InscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Inscripcion a Evento";
    public $contacto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        $this->contacto = $datos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->markdown('mail.inscriptionEvent');
    }
}
