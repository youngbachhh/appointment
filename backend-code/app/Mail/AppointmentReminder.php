<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
      return $this->html('<h1>Xin chào!</h1><p>Cuộc hẹn của bạn sắp tới...</p>')
      ->subject('Thông báo cuộc hẹn sắp tới');
    }
}