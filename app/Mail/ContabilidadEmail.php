<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContabilidadEmail extends Mailable
{
    public $coti;
    public $anio;
    public $emails;
    public $email_ventas;
    public $nombre_ventas;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($coti,$anio,$emails,$email_ventas,$nombre_ventas)
    {
        //
        $this->coti=$coti;
        $this->anio=$anio;
        $this->emails=$emails;
        $this->email_ventas=$email_ventas;
        $this->nombre_ventas=$nombre_ventas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.contabilidad.new-venta',['coti'=>$this->coti,'anio'=>$this->anio])
            ->to($this->emails)
            ->from($this->email_ventas,$this->nombre_ventas)
            ->subject('Nueva venta '.$this->coti.' (GotoPeru)');
    }
}
