<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $data;

    public function __construct($name,$data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    public function build()
    {
        $this->data["name"] = $this->name;
        return $this->subject($this->data["subject"])
                    ->view('emails.notify_student')
                    ->with([
                        'data' => $this->data,
                    ]);
    }
}
