<?php

namespace App\Http\Controllers\Pos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth As Auth;

class UnitController extends Controller
{
    public function Unit() {
        $units = Unit::latest()->orderby('name','ASC')->paginate(15);
        return view('admin.unit.unit',compact('units'));
    }

    public function Add() {
        return view('admin.unit.add');
    }

    public function Store(Request $request){

        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Name is required'
        ]);

        Unit::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Unit added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('units')->with($notification);
    }

    public function Edit($id){
        $unit = Unit::findOrFail($id);
        return view('admin.unit.edit',compact('unit'));
    }
 
    public function Update(Request $request){
        
        $id = $request->id;
        $unit = Unit::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Name is required'
        ]);

       
        Unit::findOrFail($id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()
        
        ]);

        $notification = array(
            'message' => 'Unit updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function Delete ($id){
        $unit = Unit::findOrFail($id);
       
        Unit::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Unit deleted',
            'alert-type' => 'error'
        );
        session()->flash('message','Unit deleted');
        return redirect()->route('units')->with($notification);
    }

    public function Details ($id){
        $unit = Unit::findOrFail($id);
        return view('frontend.unit_details',compact('unit'));
    }
}
