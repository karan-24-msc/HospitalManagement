<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientAdmissionRequest;
use App\Http\Requests\PatientPrescriptionRequest;
use App\Http\Requests\PatientReportRequest;
use App\Http\Requests\StaffPatientRequest;
use App\Http\Resources\AdmittedPatientResource;
use App\Http\Resources\PatientPrescriptionListResource;
use App\Http\Resources\PatientReportResource;
use App\Http\Resources\PatientResource;
use App\Models\Admission;
use App\Models\Bed;
use App\Models\Department;
use App\Models\Patient;
use App\Models\PatientInvestigation;
use App\Models\PatientPrescription;
use App\Models\Setting;
use App\Models\StaffInformation;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use PDF;

class StaffPatientManageController extends Controller
{
    public function newPatients()
    {
        $patients = Patient::with(['appointmentInfo','doctor','departmentInfo'])
            ->where('status', 0)
            ->where('assigned_doc', Auth::user()->id)
            ->get();

        $patients = PatientResource::collection($patients);

        return Inertia::render('Staff/Patients/NewPatients',[
            'patients' => $patients,
        ]);
    }

    public function regularPatients()
    {
        $patients = Patient::with(['appointmentInfo','doctor','departmentInfo'])
            ->where('status', 1)
            ->where('assigned_doc', Auth::user()->id)
            ->get();

        $patients = PatientResource::collection($patients);

        return Inertia::render('Staff/Patients/RegularPatients',[
            'patients' => $patients
        ]);
    }
    public function dischargedPatients()
    {
        $patients = Patient::with(['appointmentInfo','doctor','departmentInfo'])
            ->where('status', 3)
            ->where('assigned_doc', Auth::user()->id)
            ->get();

        $patients = PatientResource::collection($patients);

        return Inertia::render('Staff/Patients/DischargedPatients',[
            'patients' => $patients
        ]);
    }

    public function dischargeAdmission(Patient $patient)
    {
        $admissionData = Admission::where('patient_id',$patient->id)->first();
        Bed::where('id',$admissionData->bed_id)->update([
            'bed_status' => 1
        ]);

        $admissionData->update([
            'status' => 0,
        ]);

        $patient->update([
            'status' => 3
        ]);
    }

    public function admittedPatients()
    {
        $patients = Admission::with(['patient','unit','bed','doctor'])
            ->where('status', 1)
            ->where('consultant_id', Auth::user()->id)
            ->orderBy('id','DESC')
            ->get();

        $patients = AdmittedPatientResource::collection($patients);
        return Inertia::render('Staff/Patients/AdmittedPatients',[
            'patients' => $patients
        ]);
    }

    public function viewPatients()
    {
        return Inertia::render('Staff/Patients/ViewPatients');
    }

    public function fetchPatients(Request $request)
    {
        $query = $request->input('query');
        $patients = Patient::with(['appointmentInfo','doctor','departmentInfo'])
            ->where('registration_no', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('contact', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->get();

        return response()->json(['patients' => $patients]);
    }
    public function createPatient()
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        $departments = Department::where('department_status',1)->get();
        return Inertia::render('Staff/Patients/CreatePatient',[
            'departments' => $departments
        ]);
    }

    public function storePatient(StaffPatientRequest $request)
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        $currentDate = Carbon::today();
        $concatenatedDate = $currentDate->year . $currentDate->month . $currentDate->day;

        $patient = Patient::create([
            'assigned_dep' => $request->assigned_dep,
            'assigned_doc' => $request->assigned_doc,
            'registration_no' => '200'.$concatenatedDate.'-'.rand(1000,9999),
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'contact' => $request->contact,
            'opt_contact' => $request->opt_contact,
            'email' => $request->email,
            'religion' => $request->religion,
            'father_name' => $request->father_name,
            'father_bg' => $request->father_bg,
            'father_age' => $request->father_age,
            'mother_name' => $request->mother_name,
            'mother_bg' => $request->mother_bg,
            'mother_age' => $request->mother_age,
            'address' => $request->address,
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Patient Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('patient.show',$patient->id)->with($notification);
    }

    public function showPatients(Patient $patient)
    {
        return Inertia::render('Staff/Patients/ViewPatient',[
            'patient' => $patient
        ]);
    }

    public function editPatients(Patient $patient)
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        return Inertia::render('Staff/Patients/EditPatient',[
            'patient' => $patient
        ]);
    }

    public function updatePatients(StaffPatientRequest $request, Patient $patient)
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        $patient->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'contact' => $request->contact,
            'opt_contact' => $request->opt_contact,
            'email' => $request->email,
            'religion' => $request->religion,
            'father_name' => $request->father_name,
            'father_bg' => $request->father_bg,
            'father_age' => $request->father_age,
            'mother_name' => $request->mother_name,
            'mother_bg' => $request->mother_bg,
            'mother_age' => $request->mother_age,
            'address' => $request->address,
            'status' => 1,
        ]);

        $notification = array(
            'message' => 'Patient Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('patient.show',$patient->id)->with($notification);
    }

    public function processAdmission(Patient $patient)
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        $doctors =  StaffInformation::with('user')->where('department', $patient->assigned_dep)->where('emp_status',1)->get();
        $units = Unit::where('status',1)->get();
        return Inertia::render('Staff/Patients/Admission',[
            'patient' => $patient,
            'doctors' => $doctors,
            'units' => $units,
        ]);
    }

    public function fetchUnitBeds($unit)
    {
        $beds = Bed::where('unit_id',$unit)->where('bed_status',1)->where('status',1)->get();
        return response()->json($beds);
    }

    public function patientAdmissionStore(PatientAdmissionRequest $request,$patient)
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        $currentDate = Carbon::today();
        $concatenatedDate = $currentDate->year . $currentDate->month . $currentDate->day;

        $parsedDateTime = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $request->admission_date);
        $addDate = $parsedDateTime->format('Y-m-d H:i:s');

        Admission::create([
            'admission_id' => '300'.$concatenatedDate.'-'.rand(1000,9999),
            'admission_status' => 1,
            'admission_date' => $addDate,
            'unit_id' => $request->unit_id,
            'bed_id' => $request->bed_id,
            'patient_id' => $request->patient_id,
            'consultant_id' => $request->consultant_id,
        ]);

        Patient::where('id',$patient)->update([
            'status' => 2
        ]);

        Bed::where('id',$request->bed_id)->update([
           'bed_status' => 2
        ]);

        $notification = array(
            'message' => 'Patient Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('patient.show',$patient)->with($notification);
    }

    public function prescriptionProcess($patient)
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        $prescriptions = PatientPrescription::with('patientInfo')->where('patient_id',$patient)->orderBy('id','DESC')->get();
        $prescriptions = PatientPrescriptionListResource::collection($prescriptions);

        return Inertia::render('Staff/Patients/PrescriptionList',[
            'patient' => $patient,
            'prescriptions' => $prescriptions,
        ]);
    }

    public function prescriptionCreate(Patient $patient)
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        return Inertia::render('Staff/Patients/PrescriptionCreate',[
            'patient' => $patient
        ]);
    }

    public function prescriptionStore(PatientPrescriptionRequest $request)
    {
        if (Auth::user()->emp_type == 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        $validated = $request->validated();

        $parsedDateTime = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $validated['date']);
        $prescriptionDate = $parsedDateTime->format('Y-m-d H:i:s');

        PatientPrescription::create([
            'medicine_treatment' => json_encode($validated['medicine_treatment']),
            'disease_description' => $validated['disease_description'],
            'clinical_diagnosis' => $validated['clinical_diagnosis'],
            'advice' => $validated['advice'],
            'patient_id' => $validated['patient_id'],
            'doctor_id' => Auth::user()->id,
            'date' => $prescriptionDate,
        ]);
    }

    public function prescriptionEdit(PatientPrescription $patientPrescription)
    {
        $prescription = new PatientPrescriptionListResource($patientPrescription);
        return inertia('Staff/Patients/PrescriptionView', [
            'prescription' => $prescription,
        ]);
    }

    public function prescriptionDownload(PatientPrescription $patientPrescription)
    {
        $information = json_decode(Setting::first()->company_information);
        $medicines = json_decode($patientPrescription->medicine_treatment);
        $pdf = PDF::loadView('pdf.prescriptionPDF',compact('patientPrescription','medicines','information'));

        return $pdf->download($patientPrescription->patientInfo->registration_no.'-prescription.pdf');
    }

    public function patientInvestigation($patient)
    {
        $reports = PatientInvestigation::with('patientInfo')->where('patient_id',$patient)->where('status',1)->orderBy('id','DESC')->get();
        $reports = PatientReportResource::collection($reports);
        return Inertia::render('Staff/Patients/PatientInvestigations',[
            'patient' => $patient,
            'reports' => $reports,
        ]);
    }

    public function reportCreate($patient)
    {
        if (Auth::user()->emp_type != 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        return Inertia::render('Staff/Patients/PatientReportCreate',[
            'patient' => $patient
        ]);
    }

    public function reportStore(PatientReportRequest $request)
    {
        if (Auth::user()->emp_type != 'LAB_OFFICER'){
            return redirect()->route('dashboard');
        }
        PatientInvestigation::create([
            'patient_id' => $request->patient_id,
            'hematology' => json_encode($request->hematology),
            'biochemistry' => json_encode($request->biochemistry),
            'stool' => json_encode($request->stool),
            'urine' => json_encode($request->urine),
            'serology' => json_encode($request->serology),
            'immunology' => json_encode($request->immunology),
            'blood_bank' => json_encode($request->blood_bank),
            'histopathology_cytology' => json_encode($request->histopathology_cytology),
            'semen_analysis_fluid' => json_encode($request->semen_analysis_fluid),
            'microbiology' => json_encode($request->microbiology),
            'ultra_snow_gram' => json_encode($request->ultra_snow_gram),
            'x_ray' => json_encode($request->x_ray),
            'ecg' => json_encode($request->ecg),
            'eco_ett' => json_encode($request->eco_ett),
            'c_t_scan' => json_encode($request->c_t_scan),
            'others' => json_encode($request->others),
        ]);

        $notification = array(
            'message' => 'Patient Report Stored Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('patient.show',$request->patient_id)->with($notification);
    }

    public function reportView(PatientInvestigation $patientReport)
    {
        $report = new PatientReportResource($patientReport);
        return inertia('Staff/Patients/PatientReportView', [
            'report' => $report,
        ]);
    }

    public function reportDownload(PatientInvestigation $patientReport)
    {
        $information = json_decode(Setting::first()->company_information);

        $pdf = PDF::loadView('pdf.fullReportPDF',compact('patientReport','information'));

        return $pdf->download($patientReport->patientInfo->registration_no.'-full-report.pdf');
    }

    public function reportSingleDownload($id, $reportName)
    {
        $information = json_decode(Setting::first()->company_information);
        $report = PatientInvestigation::where('id',$id)->value($reportName);
        $patientReport = PatientInvestigation::where('id',$id)->first();

        $pdf = PDF::loadView('pdf.singleReportPDF',compact('report','reportName','patientReport','information'));

        return $pdf->download($patientReport->patientInfo->registration_no.'-full-report.pdf');
    }
}
