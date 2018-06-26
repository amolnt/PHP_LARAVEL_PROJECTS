<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Item_Quotation extends Mailable
{
    use Queueable, SerializesModels;
    public $data=[];
    public $result=[];
    public $message="";
    public $subject="";
    public $attach=null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdfData,$subject,$message,$attach)
    {
        $this->data=$pdfData[0]['data'];
        $this->result=$pdfData[0]['result'];
        $this->subject=$subject;
        $this->message=$message;
        $this->attach=$attach;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.quotation')->with('data',$this->data)->with('result',$this->result)
                    ->attachData(base64_decode($this->attach),"quotation.pdf",[
                            'mime'=>'application/pdf'
                        ]);
    
    }
}