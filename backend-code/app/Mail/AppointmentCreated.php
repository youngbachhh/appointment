<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentCreated extends Mailable
{
  use Queueable, SerializesModels;

  public $appointment;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($appointment)
  {
    $this->appointment = $appointment;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->html('<h1>Xin chào!</h1><p>Cuộc hẹn của bạn đã được tạo...</p>')
        ->subject('Thông báo cuộc hẹn mới');
  }
}
