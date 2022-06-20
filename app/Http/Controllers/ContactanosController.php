<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactanosMailable;
use Illuminate\Http\Request;

class ContactanosController extends Controller
{
    public function index()
    {
        return view('mail.index');
    }

    public function store(Request $request)    
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'asunto' => 'required',
            'detalle' => 'required'
        ]);
        $correo = new ContactanosMailable($request->all());
       
        Mail::to('juntar.test@fi.uncoma.edu.ar')->send($correo);
        
        return redirect()->route('home')->with('info', 'Mensaje enviado correctamente!');
    }

}
