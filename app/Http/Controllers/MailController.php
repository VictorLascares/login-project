<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function enviarCorreo(){
        $details=[
            'title' => 'Correo de prueba',
            'body' => 'curpo de correo de prueba'
        ];

        Mail::to("lascaresgallardovictormanuel@gmail.com")->send(new TestMail($details));
        return "Correo Electronico Enviado";
    }
}
