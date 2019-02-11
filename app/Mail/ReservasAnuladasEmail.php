<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservasEmail extends Mailable
{

    public $fecha;
    public $coti;
    public $id;
    public $anio;
    public $emails;
    public $email_ventas;
    public $nombre_ventas;
    public $anulada;
    
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fecha,$coti,$id,$anio,$emails,$email_ventas,$nombre_ventas,$anulada)
    {
        //
        $this->id=$id;
        $this->coti=$coti;
        $this->fecha=$fecha;
        $this->anio=$anio;
        $this->emails=$emails;
        $this->email_ventas=$email_ventas;
        $this->nombre_ventas=$nombre_ventas;
        $this->anulada=$anulada;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.book.new-venta-filtrada-anulada', ['coti'=>$this->coti,'anio'=>$this->anio,'id'=>$this->id,'nombre_ventas'=>$this->nombre_ventas,'fecha'=>$this->fecha,'anulada'=>$this->anulada])
            ->to($this->emails)
            ->from($this->email_ventas, $this->nombre_ventas)
            ->subject('Venta Anulada '.$this->coti.' (GotoPeru)');
    }
}
