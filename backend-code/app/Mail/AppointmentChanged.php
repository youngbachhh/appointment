<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function build()
    {
      return $this->html('<h1>Xin chào!</h1><p>Cuộc hẹn của bạn đã được điều chỉnh...</p>')
      ->subject('Thông báo cuộc hẹn');
    }
}