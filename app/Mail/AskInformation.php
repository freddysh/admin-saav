<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AskInformation extends Mailable
{
    public $cotizacion_id;
    public $pqt_id;
    public $email;
    public $name;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cotizacion_id,$pqt_id,$email,$name)
    {
        //
        $this->cotizacion_id=$cotizacion_id;
        $this->pqt_id=$pqt_id;
        $this->email=$email;
        $this->name=$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mails.pax.ask-information',['cotizacion_id'=>$this->cotizacion_id,'pqt_id'=>$this->pqt_id])
        ->to($this->email,$this->name)
        ->from('booking@gotoperu.com','GotoPeru')
        ->subject('More Information (GotoPeru)');
    }
}
