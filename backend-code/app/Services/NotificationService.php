<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentChanged;

class NotificationService
{
    public function sendNotifications()
    {
        $notifications = Notification::where('read', false)->get();
    
        foreach ($notifications as $notification) {
            $user = $notification->user;
            Mail::to($user->email)->send(new AppointmentChanged($notification->message));
    
            $notification->read = true;
            $notification->save();
        }
    }
}
