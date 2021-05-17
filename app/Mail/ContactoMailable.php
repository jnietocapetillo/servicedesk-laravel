<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject; //almacenamos el asunto del mensaje
    public $mensaje; //almacenamos el mensaje a enviar
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($asunto, $mensaje_correo)
    {   
        //en el constructor damos valores pasados desde el formulario
        $this->subject = $asunto;
        $this->mensaje = $mensaje_correo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //cargamos la vista que generará el correo
        return $this->view('enviarEmail1');
    }
}
