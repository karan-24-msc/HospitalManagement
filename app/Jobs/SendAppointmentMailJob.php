<?php

namespace App\Jobs;

use App\Mail\UserAppointmentMail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAppointmentMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $appointmentData;
    public function __construct($appointmentData)
    {
        $this->appointmentData = $appointmentData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $appointmentData = $this->appointmentData;

        if ($appointmentData->app_status == 1){
            $mailData = [
                'title' => 'Appointment Approved',
                'body' => 'Your Appointment has been approved at '.Carbon::parse($appointmentData->app_date)->format('F j, Y g:i A').'. You are requested to be on time.',
            ];
        }else{
            $mailData = [
                'title' => 'Appointment Declined',
                'body' => 'Your Appointment has been Declined.',
            ];
        }

        Mail::to($appointmentData->app_email)->send(new UserAppointmentMail($mailData));
    }
}
