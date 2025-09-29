<?php

namespace App\Jobs;

use App\Mail\BulkEmailMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBulkEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $id;
    protected $data;

    public function __construct($email, $name, $id, $data)
    {
        $this->email = $email;
        $this->name = $name;
        $this->id = $id;
        $this->data = $data;
    }

    public function handle()
    {
        Mail::to($this->email)->send(new BulkEmailMail($this->name,$this->id,$this->data));
    }
}
