<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Resources\StaffPatientAppointmentResource;
use App\Jobs\SendAppointmentMailJob;
use App\Models\Patient;
use App\Models\PatientAppointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppointmentManageController extends Controller
{
    public function newAppointments()
    {
        $appointments = PatientAppointment::with(['staff','departmentInfo'])
            ->where('app_status', 0)
            ->where('doctor', Auth::user()->id)
            ->get();

        $appointments = StaffPatientAppointmentResource::collection($appointments);

        return Inertia::render('Staff/Appointments/NewAppointments',[
            'appointments' => $appointments
        ]);
    }

    public function approvedAppointments()
    {
        return Inertia::render('Staff/Appointments/ApprovedAppointments');
    }

    public function approvedAppointmentsData()
    {
        $appointments = PatientAppointment::with(['staff','departmentInfo'])
            ->where('app_status', 1)
            ->where('doctor', Auth::user()->id)
            ->get();

        $appointments = StaffPatientAppointmentResource::collection($appointments);

        return response()->json([
            'appointments' => $appointments
        ], 200);
    }

    public function declinedAppointments()
    {
        $appointments = PatientAppointment::with(['staff','departmentInfo'])
            ->where('app_status', 2)
            ->where('doctor', Auth::user()->id)
            ->get();

        $appointments = StaffPatientAppointmentResource::collection($appointments);

        return Inertia::render('Staff/Appointments/DeclinedAppointments',[
            'appointments' => $appointments
        ]);
    }

    public function createPatientAppointment(PatientAppointment $appointmentId)
    {
        try {

            if ($appointmentId->patient_status == 0){
                $this->storePatientData($appointmentId);

                $appointmentId->update([
                    'patient_status' => 1
                ]);
            }

            return response()->json([
                'message' => 'Patient Data Created',
                'alert-type' => 'success',
                'appointment' => $appointmentId
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error approving appointment',
                'alert-type' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function staffPatientAppointmentApprove($id)
    {
        try {
            PatientAppointment::where('id', $id)->update(['app_status' => 1]);

            $appointmentData = PatientAppointment::where('id', $id)->first();

            dispatch(new SendAppointmentMailJob($appointmentData));

            return response()->json([
                'message' => 'Appointment Approved',
                'alert-type' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error approving appointment',
                'alert-type' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function staffPatientAppointmentDecline($id)
    {
        try {
            PatientAppointment::where('id', $id)->update(['app_status' => 2]);

            $appointmentData = PatientAppointment::where('id', $id)->first();

            dispatch(new SendAppointmentMailJob($appointmentData));

            return response()->json([
                'message' => 'Appointment Declined',
                'alert-type' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error approving appointment',
                'alert-type' => 'error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function staffPatientAppointmentChangeDateTime(Request $request,$id){

        $request->validate([
            'app_date' => 'required',
            'app_time' => 'required',
        ],[
            'app_date.required' => 'Appointment Date is Required',
            'app_time.required' => 'Appointment Time is Required',
        ]);
        //dd($request->app_date);

        $appDate = Carbon::parse($request->app_date)->format('Y-m-d');

        $appTime = $request->app_time.':00';

        $appDateTime = $appDate.' '.$appTime;


        PatientAppointment::where('id',$id)->update([
            'app_date' => $appDateTime,
            'app_status' => 1
        ]);

        $appointmentData = PatientAppointment::where('id', $id)->first();

        dispatch(new SendAppointmentMailJob($appointmentData));

        $notification = array(
            'message' => 'Appointment Time Sceduled and approved successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    private function storePatientData($appointmentData)
    {
        $currentDate = Carbon::today();
        $concatenatedDate = $currentDate->year . $currentDate->month . $currentDate->day;

       Patient::create([
           'appointment_id' =>$appointmentData->id,
           'assigned_dep' =>$appointmentData->department,
           'assigned_doc' =>$appointmentData->doctor,
           'registration_no' => '200'.$concatenatedDate.'-'.rand(1000,9999),
           'name' => $appointmentData->app_name,
           'age' => $appointmentData->app_age,
           'gender' => $appointmentData->app_gender,
           'contact' => $appointmentData->app_phone,
           'email' => $appointmentData->app_email,
           'status' => 0,
       ]);
    }
}
