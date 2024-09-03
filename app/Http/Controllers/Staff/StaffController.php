<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class StaffController extends Controller
{
    public function staffProfile()
    {
        $user = User::with('staffInformation')
            ->where('id', Auth::user()->id)
            ->first();
        $department = $user->staffInformation->departmentInfo ?? '';
        //dd($user->staffInformation->departmentInfo);
        return Inertia::render('Staff/Auth/Profile',[
            'user' => $user,
            'department' => $department,
        ]);
    }

    public function staffProfileEdit()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return Inertia::render('Staff/Auth/ProfileEdit',[
            'user' => $user,
        ]);
    }

    public function staffPasswordChange()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return Inertia::render('Staff/Auth/ChangePassword',[
            'user' => $user,
        ]);
    }

    public function staffProfileUpdate(Request $request,User $user)
    {
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = 'emp-'.rand(100,999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/employee'), $fileName);
            $image = 'upload/employee/' . $fileName;
        }

        $user->update([
            'name' => $request->name ?? $user->name,
            'phone' => $request->phone ?? $user->phone,
            'profile_photo_path' => $image ?? $user->profile_photo_path,
        ]);

        return redirect()->route('staff.profile');
    }

    public function staffPasswordUpdate(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $user->update([
            'password' => Hash::make($request->password) ?? $user->password,
        ]);

        return redirect()->route('staff.profile');
    }
}
