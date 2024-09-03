<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function unit()
    {
        $units = Unit::all();
        return view('admin.unit.units',compact('units'));
    }

    public function unitStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255']
        ]);

        Unit::create($request->all());

        $notification = array(
            'message' => 'Unit Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function unitUpdate(Request $request, $unit)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255']
        ]);

        Unit::where('id',$unit)->update($validatedData);
        $notification = array(
            'message' => 'Unit Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function unitDelete(Unit $unit)
    {
        $unit->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'Unit In Activated',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }



    public function bed()
    {
        $beds = Bed::with('unit')->get();
        $units = Unit::all();
        return view('admin.unit.beds',compact('beds','units'));
    }

    public function bedStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'unit_id' => ['required'],
            'bed_type' => ['required']
        ]);

        Bed::create($request->all());

        $notification = array(
            'message' => 'Bed Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function bedUpdate(Request $request, $bed)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'unit_id' => ['required'],
            'bed_type' => ['required']
        ]);

        Bed::where('id',$bed)->update($validatedData);
        $notification = array(
            'message' => 'Bed Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function bedDelete(Bed $bed)
    {
        $bed->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => 'Bed In Activated',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }
}
