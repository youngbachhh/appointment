<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Mail\AppointmentReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Enums\Models\Appointment\StatusType;

class SendAppointmentReminders extends Command
{
    protected $signature = 'send:appointment-reminders';
    protected $description = 'Mail nhắc nhở cuộc hẹn sắp tới';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $appointments = Appointment::where('status', StatusType::CONFIRMED->value)
            ->where('start_time', '>=', Carbon::now()->addMinutes(30))
            ->where('start_time', '<', Carbon::now()->addMinutes(60))
            ->where('reminder_sent', false)
            ->get();

        foreach ($appointments as $appointment) {
            Mail::to($appointment->user->email)->send(new AppointmentReminder($appointment));
            $appointment->reminder_sent = true;
            $appointment->save();
        }

        return 0;
    }
}