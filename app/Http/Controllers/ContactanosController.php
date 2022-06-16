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
        $correo = new ContactanosMailable($request->all());
       
        Mail::to('juntar@uncoma.edu.ar')->send($correo);
        
        return redirect()->route('home')->with('info', 'Mensaje enviado correctamente!');
    }

}
