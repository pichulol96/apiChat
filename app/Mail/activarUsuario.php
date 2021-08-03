<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class activarUsuario extends Mailable
{
    use Queueable, SerializesModels;
    public $subject="informacion de contatco";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $activar = session('codigo');
        return $this->view('emails.emailActivacion',["activar"=>$activar]);
    }
}
