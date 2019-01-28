<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservasAnularEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $fecha;
    public $coti;
    public $id;
    public $anio;
    public $emails;
    public $email_ventas;
    public $nombre_ventas;
    public $anular;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fecha,$coti,$id,$anio,$emails,$email_ventas,$nombre_ventas,$anular)
    {
        //
        $this->id=$id;
        $this->coti=$coti;
        $this->fecha=$fecha;
        $this->anio=$anio;
        $this->emails=$emails;
        $this->email_ventas=$email_ventas;
        $this->nombre_ventas=$nombre_ventas;
        $this->anular=$anular;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $anulada='activada';
        if($this->anular=='0'){
            $anulada='anulada';
        }

        return $this->view('admin.mails.book.new-venta-filtrada-anulada', ['coti'=>$this->coti,'anio'=>$this->anio,'id'=>$this->id,'nombre_ventas'=>$this->nombre_ventas,'fecha'=>$this->fecha,'anulada'=>$anulada])
            ->to($this->emails)
            ->from($this->email_ventas, $this->nombre_ventas)
            ->subject('Venta '.$anulada.' '.$this->coti.' (GotoPeru)');
    }
}
