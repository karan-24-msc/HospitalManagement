<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Staff\StaffCreateRequest;
use App\Models\Department;
use App\Models\StaffInformation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffsController extends Controller
{
    public function staffList(){
        $staffs = User::with('staffInformation')->whereHas('staffInformation', function($query) {
            $query->where('emp_status', 1);
        })->orderBy('id')->get();

        return view('admin.staff.staffList', compact('staffs'));
    }

    public function staffAdd()
    {
        $departments = Department::where('department_status', 1)->get();
        return view('admin.staff.staffAdd',compact('departments'));
    }

    public function storeStaff(StaffCreateRequest $request)
    {
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = 'emp-'.rand(100,999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/employee'), $fileName);
            $image = 'upload/employee/' . $fileName;
        }

        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'emp_type' => $request->emp_type,
            'profile_photo_path' => $image ?? '',
        ]);

        $currentDate = Carbon::today();
        $concatenatedDate = $currentDate->year . $currentDate->month . $currentDate->day;

        $data = array();

        $data['user_id'] = $employee->id;
        $data['designation'] = $request->designation;
        $data['employment_type'] = $request->employment_type;
        $data['joining_date'] = $request->joining_date;
        $data['emp_status'] = 1;

        if ($request->emp_type === 'DOCTOR'){
            $data['emp_id'] = '100'.$concatenatedDate.'-'.rand(1000,9999);
            $data['department'] = $request->department;
            $data['speciality'] = $request->speciality;
            $data['doctor_type'] = $request->doctor_type;
        }elseif ($request->emp_type === 'NURSE'){
            $data['emp_id'] = '200'.$concatenatedDate.'-'.rand(1000,9999);
            $data['department'] = $request->department;
        }else{
            $data['emp_id'] = '300'.$concatenatedDate.'-'.rand(1000,9999);
        }

        StaffInformation::create($data);

        $notification = array(
            'message' => 'Employee Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('staff.list')->with($notification);
    }

    public function editStaff(User $user)
    {
        $departments = Department::where('department_status', 1)->get();
        return view('admin.staff.staffEdit', compact('user','departments'));
    }

    public function updateStaff(Request $request)
    {
        $user = array();

        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = 'emp-'.rand(100,999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/employee'), $fileName);
            $image = 'upload/employee/' . $fileName;
            $user['profile_photo_path'] = $image;
        }

        $user['name'] = $request->name;
//        $user['email'] = $request->email;
        $user['phone'] = $request->phone;
        $user['emp_type'] = $request->emp_type;

        User::where('id',$request->id)->update($user);


        $data = array();

        $data['designation'] = $request->designation;
        $data['employment_type'] = $request->employment_type;
        $data['joining_date'] = $request->joining_date;

        if ($request->emp_type === 'DOCTOR'){
            $data['department'] = $request->department;
            $data['speciality'] = $request->speciality;
            $data['doctor_type'] = $request->doctor_type;
        }elseif ($request->emp_type === 'NURSE'){
            $data['department'] = $request->department;
        }

        StaffInformation::where('user_id',$request->id)->update($data);

        $notification = array(
            'message' => 'Employee Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('staff.list')->with($notification);
    }

    public function deleteStaff(User $user)
    {
        StaffInformation::where('user_id',$user->id)->update(['emp_status' => 0]);

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function changeStaffPassword(User $user)
    {
        return view('admin.staff.staffPasswordChange',compact('user'));
    }

    public function updateStaffPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $user->update([
            'password' => Hash::make($request->password) ?? $user->password,
        ]);

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('staff.list')->with($notification);
    }

    public function department()
    {
        $departments = Department::all();
        return view('admin.staff.department', compact('departments'));
    }

    public function departmentStore(Request $request)
    {
        $validatedData = $request->validate([
            'department_name' => ['required', 'max:255']
        ]);

        Department::create([
            'department_name' => $request->department_name,
            'department_status' => 1,
        ]);

        $notification = array(
            'message' => 'Department Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function departmentUpdate(Request $request ,Department $department)
    {
        $validatedData = $request->validate([
            'department_name' => ['required', 'max:255']
        ]);

        $department->update($validatedData);
        $notification = array(
            'message' => 'Department Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function departmentDelete(Department $department)
    {
        $department->update([
            'department_status' => 0,
        ]);

        $notification = array(
            'message' => 'Department Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
