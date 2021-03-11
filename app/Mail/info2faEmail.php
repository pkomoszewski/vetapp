<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class info2faEmail extends Mailable
{
    use Queueable, SerializesModels;
public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$status)
    {
   
        $this->user=$user;
        $this->status=$status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
     
    

        return $this->markdown('emails.2faMail')->with(['status'=>$this->status]);
    }
}
