<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientAppoointmentRequest;
use App\Models\Contact;
use App\Models\Department;
use App\Models\PatientAppointment;
use App\Models\Setting;
use App\Models\StaffInformation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        $information = json_decode(Setting::first()->company_information);
        $departments = Department::where('department_status', 1)->get();
        return Inertia::render('User/Index',[
            'information' => $information,
            'departments' => $departments,
        ]);
    }

    public function fetchDoctors($department){
        $doctors = StaffInformation::with('user')->where('department', $department)->where('emp_status',1)->get();
        return response()->json($doctors);
    }

    public function staffLoginPage()
    {
        return Inertia::render('Staff/Auth/Login');
    }

    public function storeAppointment(PatientAppoointmentRequest $request)
    {
        $parsedDateTime = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $request->date);
        $appDate = $parsedDateTime->format('Y-m-d H:i:s');

        $currentDate = Carbon::today();
        $concatenatedDate = $currentDate->year . $currentDate->month . $currentDate->day;

        PatientAppointment::create([
            'app_id' => '700'.$concatenatedDate.'-'.rand(1000,9999),
            'app_name' => $request->name,
            'app_email' => $request->email,
            'app_phone' => $request->phone,
            'app_age' => $request->app_age,
            'app_gender' => $request->app_gender,
            'department' => $request->department,
            'doctor' => $request->doctor,
            'app_date' => $appDate,
            'notes' => $request->note,
            'app_status' => 0,
        ]);
        return redirect()->route('index');
    }

    public function doctors()
    {
        $information = json_decode(Setting::first()->company_information);
        $users = StaffInformation::with(['user', 'departmentInfo'])
            ->whereHas('user', function($query) {
                $query->where('emp_type', 'DOCTOR');
            })
            ->get();
        //dd($user->staffInformation->departmentInfo);
        return Inertia::render('User/Doctor',[
            'users' => $users,
            'information' => $information,
        ]);
    }

    public function contact()
    {
        $information = json_decode(Setting::first()->company_information);
        return Inertia::render('User/Contact',[
            'information' => $information,
        ]);
    }

    public function storeContact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:30',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
        ]);
    }
}
