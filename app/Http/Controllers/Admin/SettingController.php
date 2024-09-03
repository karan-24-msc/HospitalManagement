<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\InformationRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function information()
    {
        $information = json_decode(Setting::first()->company_information);

        return view('admin.setting.information.index',compact('information'));
    }

    public function storeInformation(InformationRequest $request)
    {
        $information = json_decode(Setting::first()->company_information, true);

        $data = [];

        $data['name'] = trim($request->name) === '' ? $information['name'] : $request->name;
        $data['contact'] = trim($request->contact) === '' ? $information['contact'] : $request->contact;
        $data['email'] = trim($request->email) === '' ? $information['email'] : $request->email;
        $data['address'] = trim($request->address) === '' ? $information['address'] : $request->address;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            if (!empty($information['logo'])) {
                @unlink(public_path($information['logo']));
            }
            $fileName = 'logo-main.' .$file->getClientOriginalExtension();
            $file->move(public_path('upload'), $fileName);
            $data['logo'] = 'upload/' . $fileName;
        } else {
            $data['logo'] = $information['logo'];
        }

        $companyInformation = json_encode($data);

        Setting::where('id', 1)->update(['company_information' => $companyInformation]);

        $notification = array(
            'message' => 'Company Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
