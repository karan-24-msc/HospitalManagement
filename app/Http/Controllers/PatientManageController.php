<?php

namespace App\Http\Controllers;

use App\Jobs\SendAppointmentMailJob;
use App\Models\PatientAppointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientManageController extends Controller
{
    public function adminPatientAppointment()
    {
        $patientAppointments = PatientAppointment::get();

        return view('admin.patient_appointment.patient_appointment', compact('patientAppointments'));
    }

    public function adminPatientAppointmentApprove($id)
    {
        PatientAppointment::where('id',$id)->update([
            'app_status' => 1
        ]);

        $appointmentData = PatientAppointment::where('id',$id)->first();

        dispatch(new SendAppointmentMailJob($appointmentData));

        $notification = array(
            'message' => 'Appointment Approved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function adminPatientAppointmentDecline($id)
    {
        PatientAppointment::where('id',$id)->update([
            'app_status' => 2
        ]);

        $notification = array(
            'message' => 'Appointment Declined',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function adminPatientAppointmentUpdate(Request $request,$id){
        $date = Carbon::createFromFormat('d/m/Y', $request->app_date);
        $appDate = $date->format('Y-m-d');

        $appTime = $request->app_time.':00';

        $appDateTime = $appDate.' '.$appTime;

        PatientAppointment::where('id',$id)->update([
            'app_date' => $appDateTime,
            'app_status' => 1
        ]);

        $notification = array(
            'message' => 'Appointment Time Sceduled and approved successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
