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
    public $id;
    public $data;

    public function __construct($name,$id,$data)
    {
        $this->name = $name;
        $this->id = $id;
        $this->data = $data;
    }

    public function build()
    {
        if($this->data["type"]=="screening"){
            $this->data["url"] = "https://lms.run-putme.online";
            $screening_message = "Your exam login details are as follows:<br>Username: ".$this->id."<br>Password: ".$this->data["message"]."<br>Exam Link: ".$this->data["url"]."<br>Time: 10am";
            $this->data["message"] = $screening_message;
        }
        $this->data["name"] = $this->name;
        return $this->subject($this->data["subject"])
            ->view('emails.notify_student')
            ->with([
                'data' => $this->data,
            ]);
    }
}
