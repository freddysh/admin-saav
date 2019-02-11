<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservasEmail extends Mailable
{

    public $coti;
    public $id;
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
    public function __construct($coti,$id,$anio,$emails,$email_ventas,$nombre_ventas)
    {
        //
        $this->id=$id;
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
        return $this->view('admin.mails.book.new-venta-filtrada',['coti'=>$this->coti,'anio'=>$this->anio,'id'=>$this->id])
            ->to($this->emails)
            ->from($this->email_ventas,$this->nombre_ventas)
            ->subject('Nueva venta Cerrada '.$this->coti.' (GotoPeru)');
    }
}
